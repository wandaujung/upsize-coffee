<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {
        return view('pages.booking.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'booking_date' => 'required',
            'booking_time' => 'required',
            'people' => 'required',
            'room' => 'required',
        ]);


        Booking::create([

            'user_id' => Auth::id(),

            'name' => $request->name,

            'booking_date' => $request->booking_date,

            'booking_time' => $request->booking_time,

            'people' => $request->people,

            'room' => $request->room,

            'status' => 'pending',

        ]);


        return redirect('/booking')
            ->with('success', 'Booking berhasil dibuat');
    }
}