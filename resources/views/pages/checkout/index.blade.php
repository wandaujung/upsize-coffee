@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-5xl mx-auto px-6">


        <div class="bg-white rounded-2xl shadow-lg p-8">


            <h1 class="text-3xl font-bold text-amber-700 mb-8">
                Checkout Pesanan
            </h1>



            <div class="mb-8">

                <h2 class="text-xl font-bold mb-4">
                    Detail Produk
                </h2>


                @php
                    $total = 0;
                @endphp


                @foreach($carts as $cart)

                    @php
                        $subtotal = $cart->product->price * $cart->quantity;
                        $total += $subtotal;
                    @endphp


                    <div class="flex justify-between border-b py-3">


                        <div>

                            <p class="font-bold">
                                {{ $cart->product->name }}
                            </p>


                            <p class="text-gray-600">

                                {{ $cart->quantity }} x

                                Rp {{ number_format($cart->product->price,0,',','.') }}

                            </p>


                        </div>



                        <p class="font-bold text-amber-700">

                            Rp {{ number_format($subtotal,0,',','.') }}

                        </p>


                    </div>


                @endforeach



                <div class="flex justify-between mt-5 text-xl font-bold">


                    <span>
                        Total
                    </span>


                    <span class="text-amber-700">

                        Rp {{ number_format($total,0,',','.') }}

                    </span>


                </div>


            </div>





            <form action="{{ route('checkout.store') }}" method="POST">

                @csrf



                <div class="mb-4">


                    <label class="block mb-2">
                        Nama Pemesan
                    </label>



                    <input

                        type="text"

                        name="name"

                        value="{{ auth()->user()->name }}"

                        class="w-full border rounded-lg px-4 py-2"

                    >


                </div>





                <div class="mb-6">


                    <label class="block mb-2">
                        Nomor Meja
                    </label>



                    <input

                        type="text"

                        name="table_number"

                        placeholder="Contoh: A05"

                        class="w-full border rounded-lg px-4 py-2"

                    >


                </div>





                <button

                    class="bg-orange-600 text-white px-6 py-3 rounded-full hover:bg-orange-700">

                    Buat Pesanan

                </button>



            </form>



        </div>


    </div>


</div>


@endsection