<?php

namespace App\Http\Controllers;

use App\Models\SintiaRoomType;
use App\Models\SintiaFacility;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $roomTypes = SintiaRoomType::where('is_active', true)->get();
        $facilities = SintiaFacility::where('is_active', true)->get();
        
        return view('home', compact('roomTypes', 'facilities'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function rooms()
    {
        $roomTypes = SintiaRoomType::with('facilities')
            ->where('is_active', true)
            ->get();
        
        return view('rooms', compact('roomTypes'));
    }

    public function roomDetail($id)
    {
        $roomType = SintiaRoomType::with('facilities', 'rooms')
            ->where('is_active', true)
            ->findOrFail($id);
        
        return view('room-detail', compact('roomType'));
    }
}
