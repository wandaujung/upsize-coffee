@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-6xl mx-auto px-6">


        <div class="flex justify-between items-center mb-10">


            <div>

                <h1 class="text-3xl font-bold text-amber-700">
                    Kelola Produk
                </h1>

                <p class="text-gray-600 mt-2">
                    Daftar produk UpSize Coffee
                </p>

            </div>



            <a href="{{ route('products.create') }}"
               class="bg-orange-600 text-white px-5 py-3 rounded-full hover:bg-orange-700 transition">

                + Tambah Produk

            </a>


        </div>





        <div class="bg-white rounded-2xl shadow-lg p-6">


            <table class="w-full">


                <thead>

                    <tr class="border-b">


                        <th class="text-left py-4">
                            Gambar
                        </th>


                        <th class="text-left py-4">
                            Nama
                        </th>


                        <th class="text-center py-4">
                            Harga
                        </th>


                        <th class="text-center py-4">
                            Stok
                        </th>


                        <th class="text-center py-4">
                            Aksi
                        </th>


                    </tr>


                </thead>





                <tbody>


                @foreach($products as $product)


                    <tr class="border-b">


                        <td class="py-4">


                            <img
                                src="{{ asset('storage/'.$product->image) }}"
                                alt="{{ $product->name }}"
                                class="w-20 h-20 object-cover rounded-lg"
                            >


                        </td>





                        <td class="py-4">

                            {{ $product->name }}

                        </td>





                        <td class="text-center">

                            Rp {{ number_format($product->price,0,',','.') }}

                        </td>





                        <td class="text-center">

                            {{ $product->stock }}

                        </td>





                        <td>


                            <div class="flex justify-center gap-3">


                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-yellow-600">


                                    Edit


                                </a>





                                <form action="{{ route('products.destroy', $product->id) }}"
                                      method="POST">


                                    @csrf
                                    @method('DELETE')



                                    <button
                                        class="bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700"
                                        onclick="return confirm('Hapus produk ini?')">


                                        Hapus


                                    </button>


                                </form>


                            </div>


                        </td>


                    </tr>


                @endforeach


                </tbody>


            </table>


        </div>


    </div>


</div>


@endsection