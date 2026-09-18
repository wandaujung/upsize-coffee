@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">


        <div class="bg-white rounded-2xl shadow-lg p-8">


            <h1 class="text-3xl font-bold text-amber-700 mb-8">
                Kelola Booking
            </h1>



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
                                Nama
                            </th>


                            <th class="text-left py-3">
                                Ruangan
                            </th>


                            <th class="text-left py-3">
                                Tanggal
                            </th>


                            <th class="text-left py-3">
                                Jam
                            </th>


                            <th class="text-left py-3">
                                Orang
                            </th>


                            <th class="text-left py-3">
                                Status
                            </th>


                            <th class="text-left py-3">
                                Aksi
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                    @foreach($bookings as $booking)


                        <tr class="border-b">


                            <td class="py-4">
                                {{ $booking->name }}
                            </td>



                            <td class="py-4">

                                {{ $booking->room->name ?? '-' }}

                            </td>



                            <td class="py-4">

                                {{ $booking->booking_date }}

                            </td>



                            <td class="py-4">

                                {{ $booking->booking_time }}

                            </td>



                            <td class="py-4">

                                {{ $booking->people }}

                            </td>



                            <td class="py-4">

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">

                                    {{ $booking->status }}

                                </span>

                            </td>



                            <td class="py-4">


                                <form action="{{ route('bookings.update',$booking->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')


                                    <select name="status"
                                        class="border rounded-lg px-3 py-2">


                                        <option value="pending">
                                            Pending
                                        </option>


                                        <option value="diproses">
                                            Diproses
                                        </option>


                                        <option value="selesai">
                                            Selesai
                                        </option>


                                        <option value="ditolak">
                                            Ditolak
                                        </option>


                                    </select>


                                    <button
                                        class="bg-orange-600 text-white px-4 py-2 rounded-lg">

                                        Update

                                    </button>


                                </form>


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