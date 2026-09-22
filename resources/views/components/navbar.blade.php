<nav class="fixed top-0 left-0 w-full z-50 bg-black/40 backdrop-blur-md shadow-md">

    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <a href="/" class="flex items-center gap-3">
            <span class="text-xl">☕</span>
            <span class="text-2xl font-bold text-white">
                UpSize Coffee
            </span>
        </a>

        <div class="flex items-center gap-10">

            <a href="/" class="text-white font-semibold hover:text-orange-300">
                Home
            </a>

            <a href="/menu" class="text-white font-semibold hover:text-orange-300">
                Menu
            </a>

            <a href="/ruangan" class="text-white font-semibold hover:text-orange-300">
                Ruangan
            </a>

            <a href="/booking" class="text-white font-semibold hover:text-orange-300">
                Booking
            </a>

            <a href="/cart" class="text-white font-semibold hover:text-orange-300">
                🛒 Keranjang
            </a>

            <a href="/orders" class="text-white font-semibold hover:text-orange-300">
                Pesanan Saya
            </a>

            <form action="/logout" method="POST">
                @csrf

                <button class="text-white font-semibold hover:text-orange-300">
                    Logout
                </button>

            </form>

        </div>

    </div>

</nav>