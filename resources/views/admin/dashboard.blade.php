@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <h1 class="text-3xl font-bold text-amber-700">
                Dashboard Admin UpSize Coffee
            </h1>


            <p class="text-gray-600 mt-3">
                Selamat datang, {{ auth()->user()->name }}
            </p>



            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">


                <div class="bg-orange-100 p-6 rounded-xl">

                    <h2 class="font-bold text-lg">
                        Kelola Produk
                    </h2>

                    <p class="text-gray-600 mt-2">
                        Tambah, edit, dan hapus menu kopi.
                    </p>

                </div>



                <div class="bg-orange-100 p-6 rounded-xl">

                    <h2 class="font-bold text-lg">
                        Kelola Booking
                    </h2>

                    <p class="text-gray-600 mt-2">
                        Atur pemesanan ruangan.
                    </p>

                </div>



                <div class="bg-orange-100 p-6 rounded-xl">

                    <h2 class="font-bold text-lg">
                        Kelola Pesanan
                    </h2>

                    <p class="text-gray-600 mt-2">
                        Melihat pesanan pelanggan.
                    </p>

                </div>


            </div>


        </div>

    </div>

</div>


@endsection