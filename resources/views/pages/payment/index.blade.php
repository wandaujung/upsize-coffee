@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-3xl mx-auto px-6">

        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

            <h1 class="text-3xl font-bold text-amber-700 mb-5">
                Pembayaran Pesanan
            </h1>


            <p class="text-gray-600 mb-4">
                Pesanan #{{ $order->id }}
            </p>


            <p class="text-xl font-bold text-amber-700 mb-8">
                Rp {{ number_format($order->total_price,0,',','.') }}
            </p>


            <button
                id="pay-button"
                class="bg-orange-600 text-white px-8 py-3 rounded-full">
                Bayar Sekarang
            </button>


        </div>

    </div>

</div>


<script src="https://app.sandbox.midtrans.com/snap/snap.js"></script>

<script>

document.getElementById('pay-button').onclick = function () {

    snap.pay('{{ $order->snap_token }}', {

        onSuccess: function(result) {
            window.location.href = "/orders";
        },

        onPending: function(result) {
            window.location.href = "/orders";
        },

        onError: function(result) {
            alert('Pembayaran gagal');
        }

    });

};

</script>

@endsection