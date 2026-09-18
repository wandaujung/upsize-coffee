<nav class="absolute top-0 left-0 w-full z-50 bg-black/30 backdrop-blur-md">

    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">


        <a href="/" class="flex items-center gap-3">

            <div class="text-3xl">
                ☕
            </div>

            <h1 class="text-2xl font-bold text-white">
                UpSize Coffee
            </h1>

        </a>



        <div class="flex items-center gap-8 text-white font-medium">


            <a href="/"
               class="hover:text-orange-400 transition">
                Home
            </a>



            @auth


                @if(auth()->user()->role === 'admin')


                    <a href="/admin/products"
                       class="hover:text-orange-400 transition">
                        Kelola Menu
                    </a>


                    <a href="/admin/bookings"
                       class="hover:text-orange-400 transition">
                        Kelola Booking
                    </a>


                    <a href="/admin/orders"
                       class="hover:text-orange-400 transition">
                        Kelola Pesanan
                    </a>



                @else



                    <a href="/menu"
                       class="hover:text-orange-400 transition">
                        Menu
                    </a>


                    <a href="/ruangan"
                       class="hover:text-orange-400 transition">
                        Ruangan
                    </a>


                    <a href="/booking"
                       class="hover:text-orange-400 transition">
                        Booking
                    </a>



                    <a href="/cart"
                       class="hover:text-orange-400 transition flex items-center gap-2">

                        🛒 Keranjang


                        @if(isset($cartCount) && $cartCount > 0)

                            <span class="bg-orange-600 text-white text-xs px-2 py-1 rounded-full">

                                {{ $cartCount }}

                            </span>

                        @endif


                    </a>



                    <a href="/orders"
                       class="hover:text-orange-400 transition">
                        Pesanan Saya
                    </a>



                @endif





                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="hover:text-orange-400 transition">

                        Logout

                    </button>

                </form>




            @else



                <a href="/login"
                   class="px-5 py-2 rounded-full border border-white hover:bg-white hover:text-black transition">

                    Login

                </a>



                <a href="/register"
                   class="px-5 py-2 rounded-full bg-orange-600 hover:bg-orange-700 transition">

                    Register

                </a>



            @endauth



        </div>


    </div>


</nav>