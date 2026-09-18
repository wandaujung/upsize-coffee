@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">


        <div class="mb-10">

            <h1 class="text-3xl font-bold text-amber-700">
                Kelola Pesanan
            </h1>

            <p class="text-gray-600 mt-2">
                Daftar pesanan pelanggan
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
                            Meja
                        </th>

                        <th class="text-center py-4">
                            Total
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


                @foreach($orders as $order)

                    <tr class="border-b">


                        <td class="py-4">
                            {{ $order->name }}
                        </td>


                        <td class="text-center">
                            {{ $order->table_number }}
                        </td>


                        <td class="text-center">
                            Rp {{ number_format($order->total_price,0,',','.') }}
                        </td>


                        <td class="text-center">

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                                {{ $order->status }}

                            </span>

                        </td>


                        <td class="text-center">


                            <form action="{{ route('orders.update', $order->id) }}"
                                  method="POST">


                                @csrf
                                @method('PUT')


                                <select name="status"
                                        class="border rounded-lg px-3 py-2">


                                    <option value="pending"
                                    {{ $order->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>


                                    <option value="diproses"
                                    {{ $order->status == 'diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>


                                    <option value="selesai"
                                    {{ $order->status == 'selesai' ? 'selected' : '' }}>
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