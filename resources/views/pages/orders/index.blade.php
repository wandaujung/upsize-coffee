@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">


        <div class="text-center mb-10">

            <h1 class="text-4xl font-bold text-amber-700">
                Pesanan Saya
            </h1>

            <p class="text-gray-600 mt-3">
                Riwayat pesanan kopi kamu
            </p>

        </div>



        <div class="bg-white rounded-2xl shadow-lg p-6">


            @if($orders->count() > 0)


                @foreach($orders as $order)


                <div class="border-b py-6">


                    <div class="flex justify-between items-center mb-4">


                        <div>

                            <h2 class="text-xl font-bold">
                                Pesanan #{{ $order->id }}
                            </h2>


                            <p class="text-gray-600">
                                Meja {{ $order->table_number }}
                            </p>


                        </div>



                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">

                            {{ $order->status }}

                        </span>


                    </div>





                    @foreach($order->items as $item)


                    <div class="flex justify-between py-2">


                        <div>

                            {{ $item->product->name }}

                            <span class="text-gray-500">
                                x{{ $item->quantity }}
                            </span>


                        </div>


                        <div class="font-bold">

                            Rp {{ number_format($item->price * $item->quantity,0,',','.') }}

                        </div>


                    </div>


                    @endforeach





                    <div class="flex justify-between mt-5 text-lg font-bold">


                        <span>
                            Total
                        </span>


                        <span class="text-amber-700">

                            Rp {{ number_format($order->total_price,0,',','.') }}

                        </span>


                    </div>



                </div>


                @endforeach



            @else


                <div class="text-center py-10">

                    <p class="text-gray-600">
                        Belum ada pesanan
                    </p>


                    <a href="/menu"
                       class="inline-block mt-5 bg-orange-600 text-white px-6 py-3 rounded-full">

                        Pesan Sekarang

                    </a>


                </div>


            @endif



        </div>


    </div>


</div>


@endsection