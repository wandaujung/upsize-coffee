<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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


        $image = null;


        if ($request->hasFile('image')) {

            $image = $request->file('image')
                ->store('rooms', 'public');

        }


        Room::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'image' => $image,
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);


        $room = Room::findOrFail($id);


        $image = $room->image;


        if ($request->hasFile('image')) {

            if ($room->image) {

                Storage::disk('public')
                    ->delete($room->image);

            }


            $image = $request->file('image')
                ->store('rooms', 'public');

        }


        $room->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'description' => $request->description,
            'image' => $image,
        ]);


        return redirect()
            ->route('rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);


        if ($room->image) {

            Storage::disk('public')
                ->delete($room->image);

        }


        $room->delete();


        return redirect()
            ->route('rooms.index')
            ->with('success', 'Ruangan berhasil dihapus');
    }
}