<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SintiaRoomType;
use App\Models\SintiaRoom;
use App\Models\SintiaFacility;
use App\Models\SintiaReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total pemasukan dari reservasi yang sudah dikonfirmasi minggu ini
        $totalIncome = \App\Models\SintiaReservation::where('status', 'confirmed')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total_price');

        // User baru minggu ini
        $newGuest = \App\Models\User::where('role', 'user')
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $totalUsers = User::where('role', 'user')->count();
        $totalRooms = SintiaRoom::count();
        $totalReservations = SintiaReservation::count();
        $pendingReservations = SintiaReservation::where('status', 'pending')->count();

        // Guest Activity
        $weeklyCheckIn = \App\Models\SintiaReservation::where('status', 'checked_in')
            ->whereBetween('check_in_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
        $weeklyCheckOut = \App\Models\SintiaReservation::where('status', 'checked_out')
            ->whereBetween('check_out_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
        $monthlyCheckIn = \App\Models\SintiaReservation::where('status', 'checked_in')
            ->whereMonth('check_in_date', now()->month)
            ->whereYear('check_in_date', now()->year)
            ->count();
        $monthlyCheckOut = \App\Models\SintiaReservation::where('status', 'checked_out')
            ->whereMonth('check_out_date', now()->month)
            ->whereYear('check_out_date', now()->year)
            ->count();
        $dailyCheckIn = \App\Models\SintiaReservation::where('status', 'checked_in')
            ->whereDate('check_in_date', now()->toDateString())
            ->count();
        $dailyCheckOut = \App\Models\SintiaReservation::where('status', 'checked_out')
            ->whereDate('check_out_date', now()->toDateString())
            ->count();

        $recentReservations = SintiaReservation::with(['user', 'room.roomType'])
            ->latest()
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalIncome',
            'newGuest',
            'totalUsers',
            'totalRooms',
            'totalReservations',
            'pendingReservations',
            'recentReservations',
            'weeklyCheckIn',
            'weeklyCheckOut',
            'monthlyCheckIn',
            'monthlyCheckOut',
            'dailyCheckIn',
            'dailyCheckOut'
        ));
    }

    public function users()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function roomTypes()
    {
        $roomTypes = SintiaRoomType::with('facilities')->latest()->paginate(10);
        $facilities = SintiaFacility::where('is_active', true)->get();
        return view('admin.room-types', compact('roomTypes', 'facilities'));
    }

    public function storeRoomType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price_per_night' => $request->price_per_night,
            'capacity' => $request->capacity,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('room_types', 'public');
        }

        $roomType = SintiaRoomType::create($data);

        if ($request->has('facilities')) {
            $roomType->facilities()->attach($request->facilities);
        }

        return redirect()->back()->with('success', 'Tipe kamar berhasil ditambahkan!');
    }

    public function updateRoomType(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $roomType = SintiaRoomType::findOrFail($id);
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price_per_night' => $request->price_per_night,
            'capacity' => $request->capacity,
            'is_active' => $request->is_active ?? 1,
        ];
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($roomType->image && Storage::disk('public')->exists($roomType->image)) {
                Storage::disk('public')->delete($roomType->image);
            }
            $data['image'] = $request->file('image')->store('room_types', 'public');
        }
        $roomType->update($data);
        $roomType->facilities()->sync($request->facilities ?? []);

        return redirect()->back()->with('success', 'Tipe kamar berhasil diperbarui!');
    }

    public function rooms()
    {
        $rooms = SintiaRoom::with('roomType')->latest()->paginate(10);
        $roomTypes = SintiaRoomType::where('is_active', true)->get();
        return view('admin.rooms', compact('rooms', 'roomTypes'));
    }

    public function storeRoom(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|unique:sintia_rooms,room_number',
            'room_type_id' => 'required|exists:sintia_room_types,id',
            'notes' => 'nullable|string',
        ]);

        SintiaRoom::create([
            'room_number' => $request->room_number,
            'room_type_id' => $request->room_type_id,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function facilities()
    {
        $facilities = SintiaFacility::latest()->paginate(10);
        return view('admin.facilities', compact('facilities'));
    }

    public function storeFacility(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        SintiaFacility::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return redirect()->back()->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function reservations()
    {
        $reservations = SintiaReservation::with(['user', 'room.roomType'])
            ->latest()
            ->paginate(10);
        
        return view('admin.reservations', compact('reservations'));
    }

    public function updateReservationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
            'admin_notes' => 'nullable|string',
        ]);

        $reservation = SintiaReservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }
}
