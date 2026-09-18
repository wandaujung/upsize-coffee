@extends('layouts.app')


@section('content')

<div class="bg-gray-100 min-h-screen py-16">

    <div class="max-w-5xl mx-auto px-6">


        <div class="bg-white rounded-2xl shadow-lg p-10 text-center">


            <h1 class="text-4xl font-bold text-amber-700">
                Selamat Datang di UpSize Coffee
            </h1>


            <p class="mt-4 text-gray-600 text-lg">
                Halo, {{ Auth::user()->name }}
            </p>


            <p class="mt-2 text-gray-500">
                Kamu berhasil login ke sistem.
            </p>



            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-5">


                <a href="/menu"
                    class="bg-orange-600 text-white py-4 rounded-xl hover:bg-orange-700">

                    Lihat Menu

                </a>



                <a href="/cart"
                    class="bg-gray-800 text-white py-4 rounded-xl hover:bg-gray-900">

                    Keranjang

                </a>



                <a href="/profile"
                    class="border border-gray-300 py-4 rounded-xl hover:bg-gray-100">

                    Profile

                </a>


            </div>


        </div>


    </div>

</div>


@endsection