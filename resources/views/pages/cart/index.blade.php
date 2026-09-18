@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">


        <div class="text-center mb-10">

            <h1 class="text-4xl font-bold text-amber-700">
                Keranjang Saya
            </h1>

            <p class="text-gray-600 mt-3">
                Daftar kopi yang sudah kamu pilih
            </p>

        </div>



        <div class="bg-white rounded-2xl shadow-lg p-6">


            @if($carts->count() > 0)


                @foreach($carts as $cart)

                <div class="flex items-center justify-between border-b py-5">


                    <div class="flex items-center gap-5">


                        <img
                            src="{{ asset('images/'.$cart->product->image) }}"
                            class="w-24 h-24 object-cover rounded-xl"
                        >


                        <div>

                            <h2 class="text-xl font-bold text-gray-800">
                                {{ $cart->product->name }}
                            </h2>


                            <p class="text-gray-600">
                                Jumlah : {{ $cart->quantity }}
                            </p>


                            <p class="text-amber-700 font-bold">
                                Rp {{ number_format($cart->product->price,0,',','.') }}
                            </p>

                        </div>


                    </div>



                    <form
                        action="{{ route('cart.destroy', $cart->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?');"
                    >

                        @csrf

                        @method('DELETE')


                        <button
                            type="submit"
                            class="bg-red-600 text-white px-5 py-2 rounded-full hover:bg-red-700 transition">

                            Hapus

                        </button>


                    </form>



                </div>


                @endforeach



                <div class="mt-8 flex justify-between items-center">


                    <h2 class="text-2xl font-bold text-gray-800">
                        Total Belanja
                    </h2>


                    <span class="text-2xl font-bold text-amber-700">
                        Rp {{ number_format($total,0,',','.') }}
                    </span>


                </div>



            @else


                <div class="text-center py-10">

                    <p class="text-gray-600">
                        Keranjang masih kosong
                    </p>


                    <a href="/menu"
                       class="inline-block mt-5 bg-orange-600 text-white px-6 py-3 rounded-full">

                        Lihat Menu

                    </a>

                </div>


            @endif


        </div>


    </div>


</div>


@endsection