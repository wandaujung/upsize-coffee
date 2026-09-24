@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen pt-28 pb-16">

    <div class="max-w-5xl mx-auto px-6">


        <div class="bg-white rounded-2xl shadow-lg p-8">


            <h1 class="text-3xl font-bold text-amber-700 mb-6">
                Booking Ruangan
            </h1>




            @if(session()->has('success'))

                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-5">

                    {{ session('success') }}

                </div>

            @endif




            @if($errors->any())

                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-5">

                    @foreach($errors->all() as $error)

                        <p>{{ $error }}</p>

                    @endforeach

                </div>

            @endif






            <form action="{{ route('booking.store') }}" method="POST">

                @csrf





                <div class="mb-6">

                    <label class="block mb-2 font-semibold">
                        Nama Pemesan
                    </label>


                    <input
                        type="text"
                        name="name"
                        value="{{ auth()->user()->name }}"
                        class="w-full border rounded-lg px-4 py-2">

                </div>







                <div class="mb-6">

                    <label class="block mb-4 font-semibold">
                        Pilih Ruangan
                    </label>



                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">



                        @foreach($rooms as $room)


                        <label class="cursor-pointer">


                            <input
                                type="radio"
                                name="room_id"
                                value="{{ $room->id }}"
                                class="hidden peer"
                                required>



                            <div class="border rounded-xl overflow-hidden shadow-md 
                                hover:shadow-xl
                                transition
                                peer-checked:ring-4 
                                peer-checked:ring-orange-400">



                                @if($room->image)

                                    <img
                                        src="{{ asset('storage/'.$room->image) }}"
                                        alt="{{ $room->name }}"
                                        class="w-full h-48 object-cover">


                                @else


                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">

                                        Tidak ada gambar

                                    </div>


                                @endif






                                <div class="p-5">


                                    <h2 class="text-xl font-bold text-amber-700">

                                        {{ $room->name }}

                                    </h2>



                                    <p class="text-gray-600 mt-2">

                                        Kapasitas:
                                        {{ $room->capacity }}
                                        orang

                                    </p>




                                    <p class="text-gray-500 text-sm mt-3">

                                        {{ $room->description }}

                                    </p>



                                </div>



                            </div>


                        </label>


                        @endforeach



                    </div>



                </div>








                <div class="mb-4">

                    <label class="block mb-2">
                        Tanggal Booking
                    </label>


                    <input
                        type="date"
                        name="booking_date"
                        class="w-full border rounded-lg px-4 py-2">

                </div>







                <div class="mb-4">

                    <label class="block mb-2">
                        Jam Booking
                    </label>


                    <input
                        type="time"
                        name="booking_time"
                        class="w-full border rounded-lg px-4 py-2">

                </div>







                <div class="mb-6">

                    <label class="block mb-2">
                        Jumlah Orang
                    </label>


                    <input
                        type="number"
                        name="people"
                        class="w-full border rounded-lg px-4 py-2">

                </div>








                <button
                    type="submit"
                    class="bg-orange-600 text-white px-6 py-3 rounded-full hover:bg-orange-700">

                    Booking Sekarang

                </button>




            </form>



        </div>


    </div>


</div>


@endsection