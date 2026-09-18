<?php

namespace App\Http\Controllers;

use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return view('pages.rooms.index', compact('rooms'));
    }
}