<nav class="absolute top-0 left-0 w-full z-50 bg-black/30 backdrop-blur-md">

    <div class="max-w-7xl mx-auto px-6 py-5 
                flex justify-between items-center">


        {{-- Logo --}}
        <a href="/" class="flex items-center gap-3">

            <div class="text-3xl">
                ☕
            </div>

            <h1 class="text-2xl font-bold text-white">
                UpSize Coffee
            </h1>

        </a>



        {{-- Menu --}}
        <div class="flex items-center gap-8 text-white font-medium">


            <a href="/"
               class="hover:text-orange-400 transition">
                Home
            </a>


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
               class="hover:text-orange-400 transition">
                🛒 Keranjang
            </a>



            @auth

                <a href="/dashboard"
                   class="hover:text-orange-400 transition">
                    Dashboard
                </a>


            @else


                <a href="/login"
                   class="px-5 py-2 rounded-full 
                          border border-white
                          hover:bg-white
                          hover:text-black
                          transition">
                    Login
                </a>


                <a href="/register"
                   class="px-5 py-2 rounded-full
                          bg-orange-600
                          hover:bg-orange-700
                          transition">
                    Register
                </a>


            @endauth


        </div>


    </div>

</nav>