@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-amber-700">
                Menu UpSize Coffee
            </h1>

            <p class="text-gray-600 mt-3">
                Nikmati berbagai pilihan kopi terbaik kami
            </p>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">


            @foreach($products as $product)

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden 
                        hover:shadow-xl transition duration-300">


                <img 
                    src="{{ asset('images/'.$product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-56 object-cover"
                >


                <div class="p-6">


                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $product->name }}
                    </h2>


                    <p class="text-gray-600 mt-3 text-sm leading-relaxed">
                        {{ $product->description }}
                    </p>


                    <div class="flex justify-between items-center mt-5">


                        <span class="text-xl font-bold text-amber-700">
                            Rp {{ number_format($product->price,0,',','.') }}
                        </span>


                        <span class="text-sm text-gray-500">
                            Stok {{ $product->stock }}
                        </span>


                    </div>


                    <button
                        class="w-full mt-6 bg-orange-600 text-white py-3 rounded-full
                               hover:bg-orange-700 transition">

                        + Tambah Keranjang

                    </button>


                </div>


            </div>


            @endforeach


        </div>


    </div>

</div>


@endsection