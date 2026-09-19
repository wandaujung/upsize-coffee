<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->get();

        return view('admin.rooms.index', compact('rooms'));
    }


    public function create()
    {
        return view('admin.rooms.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required',
            'description' => 'required',
            'image' => 'nullable'
        ]);


        Room::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'image' => $request->image,
        ]);


        return redirect()
            ->route('rooms.index')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $room = Room::findOrFail($id);

        return view('admin.rooms.edit', compact('room'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required',
            'description' => 'required',
            'image' => 'nullable'
        ]);


        $room = Room::findOrFail($id);


        $room->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'image' => $request->image,
        ]);


        return redirect()
            ->route('rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);

        $room->delete();


        return redirect()
            ->route('rooms.index')
            ->with('success', 'Ruangan berhasil dihapus');
    }
}