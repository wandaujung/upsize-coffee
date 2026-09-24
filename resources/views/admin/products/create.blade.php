@extends('layouts.app')

@section('content')

<div class="bg-gray-100 min-h-screen py-12">

    <div class="max-w-3xl mx-auto px-6">


        <div class="bg-white rounded-2xl shadow-lg p-8">


            <h1 class="text-3xl font-bold text-amber-700 mb-6">
                Tambah Produk
            </h1>



            <form action="{{ route('products.store') }}" 
                  method="POST"
                  enctype="multipart/form-data">

                @csrf



                <div class="mb-4">

                    <label class="block mb-2">
                        Nama Produk
                    </label>


                    <input 
                        type="text"
                        name="name"
                        class="w-full border rounded-lg px-4 py-2">

                </div>




                <div class="mb-4">

                    <label class="block mb-2">
                        Deskripsi
                    </label>


                    <textarea
                        name="description"
                        class="w-full border rounded-lg px-4 py-2"></textarea>

                </div>




                <div class="mb-4">

                    <label class="block mb-2">
                        Harga
                    </label>


                    <input 
                        type="number"
                        name="price"
                        class="w-full border rounded-lg px-4 py-2">

                </div>




                <div class="mb-4">

                    <label class="block mb-2">
                        Stok
                    </label>


                    <input 
                        type="number"
                        name="stock"
                        class="w-full border rounded-lg px-4 py-2">

                </div>




                <div class="mb-6">

                    <label class="block mb-2">
                        Gambar Produk
                    </label>


                    <input 
                        type="file"
                        name="image"
                        class="w-full border rounded-lg px-4 py-2">

                </div>




                <button
                    class="bg-orange-600 text-white px-6 py-3 rounded-full">

                    Simpan Produk

                </button>


            </form>


        </div>


    </div>

</div>

@endsection