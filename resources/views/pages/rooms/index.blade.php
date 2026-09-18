@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">


        <div class="text-center mb-10">

            <h1 class="text-4xl font-bold text-amber-700">
                Pilihan Ruangan
            </h1>

            <p class="text-gray-600 mt-3">
                Pilih ruangan yang sesuai untuk kebutuhan kamu
            </p>

        </div>



        <div class="grid md:grid-cols-3 gap-8">


            @foreach($rooms as $room)


            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">


                @if($room->image)

                    <img
                        src="{{ asset('images/'.$room->image) }}"
                        class="w-full h-48 object-cover"
                    >

                @else

                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">

                        <span class="text-gray-500">
                            No Image
                        </span>

                    </div>

                @endif




                <div class="p-6">


                    <h2 class="text-2xl font-bold text-gray-800">

                        {{ $room->name }}

                    </h2>



                    <p class="text-gray-600 mt-2">

                        Kapasitas:
                        {{ $room->capacity }}
                        orang

                    </p>



                    <p class="text-gray-600 mt-3">

                        {{ $room->description }}

                    </p>



                </div>


            </div>


            @endforeach



        </div>



    </div>

</div>

@endsection