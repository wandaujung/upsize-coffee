@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-3xl mx-auto px-6">


        <div class="bg-white rounded-2xl shadow-lg p-8">


            <h1 class="text-3xl font-bold text-amber-700 mb-6">
                Edit Ruangan
            </h1>



            <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')



                <div class="mb-4">

                    <label class="block mb-2">
                        Nama Ruangan
                    </label>


                    <input
                        type="text"
                        name="name"
                        value="{{ $room->name }}"
                        class="w-full border rounded-lg px-4 py-2"
                        required>

                </div>




                <div class="mb-4">

                    <label class="block mb-2">
                        Kapasitas
                    </label>


                    <input
                        type="number"
                        name="capacity"
                        value="{{ $room->capacity }}"
                        class="w-full border rounded-lg px-4 py-2"
                        required>

                </div>




                <div class="mb-4">

                    <label class="block mb-2">
                        Deskripsi
                    </label>


                    <textarea
                        name="description"
                        class="w-full border rounded-lg px-4 py-2"
                        required>{{ $room->description }}</textarea>

                </div>




                <div class="mb-6">

                    <label class="block mb-2">
                        Gambar Ruangan
                    </label>


                    @if($room->image)

                        <img 
                            src="{{ asset('storage/'.$room->image) }}"
                            class="w-40 h-32 object-cover rounded-lg mb-3"
                        >

                    @endif



                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="w-full border rounded-lg px-4 py-2">

                    <p class="text-sm text-gray-500 mt-2">
                        Kosongkan jika tidak ingin mengganti gambar
                    </p>

                </div>




                <button
                    class="bg-orange-600 text-white px-6 py-3 rounded-lg">

                    Update

                </button>


            </form>


        </div>


    </div>


</div>

@endsection