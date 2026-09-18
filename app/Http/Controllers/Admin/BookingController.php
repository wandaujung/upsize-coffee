<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->get();

        return view('admin.bookings.index', compact('bookings'));
    }


    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required'
        ]);


        $booking->update([
            'status' => $request->status
        ]);


        return redirect()
            ->route('bookings.index');
    }
}