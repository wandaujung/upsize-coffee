@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen pt-28 pb-16">

    <div class="max-w-7xl mx-auto px-6">


        <h1 class="text-4xl font-bold text-amber-700 mb-3">
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





        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">


            <div class="bg-white rounded-2xl shadow-lg p-8">


                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Persentase Produk Terlaris
                </h2>


                <div class="max-w-md mx-auto">

                    <canvas id="salesChart"></canvas>

                </div>


            </div>





            <div class="bg-white rounded-2xl shadow-lg p-8">


                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Produk Terlaris
                </h2>


                <div class="space-y-4">


                    @foreach($topProducts as $product)

                    <div class="flex justify-between items-center border-b pb-3">

                        <span class="font-semibold text-gray-700">
                            {{ $product->name }}
                        </span>


                        <span class="text-amber-700 font-bold">
                            {{ $product->total }} terjual
                        </span>

                    </div>


                    @endforeach


                </div>


            </div>


        </div>






        <div class="bg-white rounded-2xl shadow-lg p-8 mb-10">


            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Grafik Penjualan Bulanan
            </h2>


            <canvas id="monthlyChart"></canvas>


        </div>







        <div class="bg-white rounded-2xl shadow-lg p-8">


            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Pesanan Terbaru
            </h2>



            <div class="overflow-x-auto">


                <table class="w-full">


                    <thead>

                        <tr class="border-b text-left">

                            <th class="py-3">
                                Nama
                            </th>

                            <th class="py-3">
                                Total
                            </th>

                            <th class="py-3">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @foreach($latestOrders as $order)


                        <tr class="border-b">


                            <td class="py-3">
                                {{ $order->name }}
                            </td>


                            <td class="py-3">
                                Rp {{ number_format($order->total_price,0,',','.') }}
                            </td>


                            <td class="py-3">
                                {{ $order->status }}
                            </td>


                        </tr>


                        @endforeach


                    </tbody>


                </table>


            </div>


        </div>



    </div>

</div>





<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


new Chart(document.getElementById('salesChart'), {


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





new Chart(document.getElementById('monthlyChart'), {


    type: 'line',


    data: {


        labels: {!! json_encode($monthlySales->pluck('month')) !!},


        datasets: [{


            label: 'Pendapatan',

            data: {!! json_encode($monthlySales->pluck('total')) !!},


            borderWidth: 2


        }]

    },


    options: {

        responsive: true

    }


});


</script>



@endsection