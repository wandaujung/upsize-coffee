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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);


        $imageName = null;


        if ($request->hasFile('image')) {

            $imageName = $request->file('image')
                ->store('rooms', 'public');

        }


        Room::create([

            'name' => $request->name,

            'capacity' => $request->capacity,

            'description' => $request->description,

            'image' => $imageName,

        ]);


        return redirect()
            ->route('rooms.index')
            ->with('success', 'Ruangan berhasil ditambahkan');
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);


        $room = Room::findOrFail($id);


        $imageName = $room->image;


        if ($request->hasFile('image')) {

            $imageName = $request->file('image')
                ->store('rooms', 'public');

        }



        $room->update([

            'name' => $request->name,

            'capacity' => $request->capacity,

            'description' => $request->description,

            'image' => $imageName,

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