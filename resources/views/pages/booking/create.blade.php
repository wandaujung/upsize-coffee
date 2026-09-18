@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-3xl mx-auto px-6">


        <div class="bg-white rounded-2xl shadow-lg p-8">


            <h1 class="text-3xl font-bold text-amber-700 mb-6">
                Booking Ruangan
            </h1>


            @if(session('success'))

                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-5">
                    {{ session('success') }}
                </div>

            @endif



            <form action="{{ route('booking.store') }}" method="POST">

                @csrf


                <div class="mb-4">

                    <label class="block mb-2">
                        Nama Pemesan
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ auth()->user()->name }}"
                        class="w-full border rounded-lg px-4 py-2">

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



                <div class="mb-4">

                    <label class="block mb-2">
                        Jumlah Orang
                    </label>

                    <input
                        type="number"
                        name="people"
                        class="w-full border rounded-lg px-4 py-2">

                </div>



                <div class="mb-6">

                    <label class="block mb-2">
                        Pilih Ruangan
                    </label>


                    <select
                        name="room"
                        class="w-full border rounded-lg px-4 py-2">


                        <option value="">
                            Pilih Ruangan
                        </option>


                        <option value="Indoor">
                            Indoor
                        </option>


                        <option value="Outdoor">
                            Outdoor
                        </option>


                        <option value="VIP">
                            VIP Room
                        </option>


                    </select>


                </div>



                <button
                    class="bg-orange-600 text-white px-6 py-3 rounded-full hover:bg-orange-700">

                    Booking Sekarang

                </button>


            </form>


        </div>


    </div>

</div>

@endsection