<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {
        $rooms = Room::all();

        return view('pages.booking.create', compact('rooms'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required',
            'booking_time' => 'required',
            'people' => 'required',
        ]);


        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'name' => $request->name,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'people' => $request->people,
            'status' => 'pending',
        ]);


        return redirect()
            ->route('booking.create')
            ->with('success', 'Booking berhasil dibuat');
    }
}