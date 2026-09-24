@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">

        <div class="bg-white rounded-2xl shadow-lg p-8">


            <div class="flex justify-between items-center mb-8">

                <div>

                    <h1 class="text-3xl font-bold text-amber-700">
                        Kelola Ruangan
                    </h1>

                    <p class="text-gray-600 mt-2">
                        Daftar ruangan UpSize Coffee
                    </p>

                </div>


                <a href="{{ route('rooms.create') }}"
                    class="bg-orange-600 text-white px-5 py-3 rounded-lg hover:bg-orange-700">

                    Tambah Ruangan

                </a>

            </div>


            @if(session('success'))

                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-5">

                    {{ session('success') }}

                </div>

            @endif


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b">

                            <th class="text-left py-3">
                                Gambar
                            </th>

                            <th class="text-left py-3">
                                Nama
                            </th>

                            <th class="text-left py-3">
                                Kapasitas
                            </th>

                            <th class="text-left py-3">
                                Deskripsi
                            </th>

                            <th class="text-left py-3">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @foreach($rooms as $room)

                        <tr class="border-b">

                            <td class="py-4">

                                <img
                                    src="{{ asset('storage/'.$room->image) }}"
                                    alt="{{ $room->name }}"
                                    class="w-24 h-20 object-cover rounded-lg"
                                >

                            </td>


                            <td class="py-4">

                                {{ $room->name }}

                            </td>


                            <td class="py-4">

                                {{ $room->capacity }} orang

                            </td>


                            <td class="py-4">

                                {{ $room->description }}

                            </td>


                            <td class="py-4">

                                <div class="flex gap-2">


                                    <a href="{{ route('rooms.edit',$room->id) }}"
                                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">

                                        Edit

                                    </a>


                                    <form action="{{ route('rooms.destroy',$room->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')


                                        <button
                                            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700"
                                            onclick="return confirm('Hapus ruangan ini?')">

                                            Hapus

                                        </button>


                                    </form>


                                </div>

                            </td>


                        </tr>


                    @endforeach

                    </tbody>

                </table>

            </div>


        </div>

    </div>

</div>

@endsection