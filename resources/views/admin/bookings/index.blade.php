@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">


        <div class="mb-10">

            <h1 class="text-3xl font-bold text-amber-700">
                Kelola Booking
            </h1>

            <p class="text-gray-600 mt-2">
                Daftar pemesanan ruangan pelanggan
            </p>

        </div>



        <div class="bg-white rounded-2xl shadow-lg p-6">


            <table class="w-full">


                <thead>

                    <tr class="border-b">


                        <th class="text-left py-4">
                            Nama
                        </th>


                        <th class="text-center py-4">
                            Tanggal
                        </th>


                        <th class="text-center py-4">
                            Jam
                        </th>


                        <th class="text-center py-4">
                            Orang
                        </th>


                        <th class="text-center py-4">
                            Ruangan
                        </th>


                        <th class="text-center py-4">
                            Status
                        </th>


                        <th class="text-center py-4">
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


                        <td class="text-center">
                            {{ $booking->booking_date }}
                        </td>


                        <td class="text-center">
                            {{ $booking->booking_time }}
                        </td>


                        <td class="text-center">
                            {{ $booking->people }}
                        </td>


                        <td class="text-center">
                            {{ $booking->room }}
                        </td>


                        <td class="text-center">

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                                {{ $booking->status }}

                            </span>

                        </td>



                        <td class="text-center">


                            <form action="{{ route('bookings.update', $booking->id) }}"
                                  method="POST">


                                @csrf
                                @method('PUT')


                                <select name="status"
                                        class="border rounded-lg px-3 py-2">


                                    <option value="pending"
                                        {{ $booking->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>


                                    <option value="diterima"
                                        {{ $booking->status == 'diterima' ? 'selected' : '' }}>
                                        Diterima
                                    </option>


                                    <option value="selesai"
                                        {{ $booking->status == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>


                                </select>


                                <button
                                    class="bg-orange-600 text-white px-4 py-2 rounded-full ml-2">

                                    Simpan

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


@endsection