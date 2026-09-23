@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen pt-28 pb-16">

    <div class="max-w-7xl mx-auto px-6">


        <h1 class="text-4xl font-bold text-amber-700 mb-8">
            Statistik Penjualan UpSize Coffee
        </h1>


        <p class="text-gray-600 mb-10">
            Selamat datang, {{ auth()->user()->name }}
        </p>


        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">


            <div class="bg-white rounded-2xl shadow-lg p-6">

                <p class="text-gray-500">
                    Total Pendapatan
                </p>

                <h2 class="text-3xl font-bold text-amber-700 mt-3">
                    Rp {{ number_format($totalRevenue,0,',','.') }}
                </h2>

            </div>



            <div class="bg-white rounded-2xl shadow-lg p-6">

                <p class="text-gray-500">
                    Total Pesanan
                </p>

                <h2 class="text-3xl font-bold text-amber-700 mt-3">
                    {{ $totalOrders }}
                </h2>

            </div>




            <div class="bg-white rounded-2xl shadow-lg p-6">

                <p class="text-gray-500">
                    Total Booking
                </p>

                <h2 class="text-3xl font-bold text-amber-700 mt-3">
                    {{ $totalBookings }}
                </h2>

            </div>




            <div class="bg-white rounded-2xl shadow-lg p-6">

                <p class="text-gray-500">
                    Total Produk
                </p>

                <h2 class="text-3xl font-bold text-amber-700 mt-3">
                    {{ $totalProducts }}
                </h2>

            </div>



        </div>



        <div class="bg-white rounded-2xl shadow-lg p-8">


            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Persentase Produk Terlaris
            </h2>


            <div class="max-w-lg mx-auto">

                <canvas id="salesChart"></canvas>

            </div>


        </div>


    </div>

</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


const ctx = document.getElementById('salesChart');


new Chart(ctx, {


    type: 'doughnut',


    data: {


        labels: {!! json_encode($salesChart->pluck('name')) !!},


        datasets: [{

            data: {!! json_encode($salesChart->pluck('total')) !!},


            borderWidth: 1

        }]

    },


    options: {


        responsive: true,


        plugins: {


            legend: {

                position: 'bottom'

            }


        }


    }


});


</script>


@endsection