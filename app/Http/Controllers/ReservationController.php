<?php

namespace App\Http\Controllers;

use App\Models\SintiaRoom;
use App\Models\SintiaRoomType;
use App\Models\SintiaReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reservations = SintiaReservation::where('user_id', Auth::id())
            ->with('room.roomType')
            ->latest()
            ->paginate(10);
        
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $roomTypes = SintiaRoomType::where('is_active', true)->get();
        return view('reservations.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required|exists:sintia_room_types,id',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        // Find available room
        $roomType = SintiaRoomType::findOrFail($request->room_type_id);
        $availableRoom = SintiaRoom::where('room_type_id', $request->room_type_id)
            ->where('status', 'available')
            ->first();

        if (!$availableRoom) {
            return back()->withErrors(['room_type_id' => 'Maaf, kamar tipe ini tidak tersedia.'])->withInput();
        }

        // Calculate total price
        $checkIn = \Carbon\Carbon::parse($request->check_in_date);
        $checkOut = \Carbon\Carbon::parse($request->check_out_date);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $roomType->price_per_night * $nights;

        // Create reservation
        $reservation = SintiaReservation::create([
            'user_id' => Auth::id(),
            'room_id' => $availableRoom->id,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'number_of_guests' => $request->number_of_guests,
            'total_price' => $totalPrice,
            'special_requests' => $request->special_requests,
            'status' => 'pending',
        ]);

        // Update room status
        $availableRoom->update(['status' => 'occupied']);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservasi berhasil dibuat! Menunggu konfirmasi admin.');
    }

    public function show($id)
    {
        $reservation = SintiaReservation::where('user_id', Auth::id())
            ->with('room.roomType')
            ->findOrFail($id);
        
        return view('reservations.show', compact('reservation'));
    }

    public function cancel($id)
    {
        $reservation = SintiaReservation::where('user_id', Auth::id())->findOrFail($id);
        
        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Hanya reservasi yang masih pending yang dapat dibatalkan.');
        }

        $reservation->update(['status' => 'cancelled']);
        
        // Update room status back to available
        $reservation->room->update(['status' => 'available']);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservasi berhasil dibatalkan.');
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $availableRooms = SintiaRoom::where('status', 'available')
            ->with('roomType')
            ->get()
            ->groupBy('room_type_id');

        return response()->json($availableRooms);
    }
}
