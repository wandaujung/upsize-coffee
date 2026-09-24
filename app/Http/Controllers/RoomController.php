<?php

namespace App\Http\Controllers;

use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->get();

        return view('pages.rooms.index', compact('rooms'));
    }
}