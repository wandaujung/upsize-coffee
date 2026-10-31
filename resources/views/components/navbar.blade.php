
<nav class="fixed top-0 left-0 w-full z-50 bg-black/40 backdrop-blur-md shadow-md">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        <a href="/" class="flex items-center gap-3">
            <span class="text-xl">&#9749;</span>
            <span class="text-2xl font-bold text-white">
                UpSize Coffee
            </span>
        </a>

        <div class="flex items-center gap-8">

            @if(auth()->check() && auth()->user()->role == 'admin')

                <a href="/admin/dashboard"
                    class="text-white font-semibold hover:text-orange-300">
                    Statistik Penjualan
                </a>

                <a href="/admin/products"
                    class="text-white font-semibold hover:text-orange-300">
                    Kelola Produk
                </a>

                <a href="/admin/bookings"
                    class="text-white font-semibold hover:text-orange-300">
                    Kelola Booking
                </a>

                <a href="/admin/rooms"
                    class="text-white font-semibold hover:text-orange-300">
                    Kelola Ruangan
                </a>

                <a href="/admin/orders"
                    class="text-white font-semibold hover:text-orange-300">
                    Kelola Pesanan
                </a>

            @else

                @php
                    $cartCount = auth()->check()
                        ? (int) \App\Models\Cart::where('user_id', auth()->id())->sum('quantity')
                        : 0;
                @endphp

                <a href="/"
                    class="text-white font-semibold hover:text-orange-300">
                    Home
                </a>

                <a href="/menu"
                    class="text-white font-semibold hover:text-orange-300">
                    Menu
                </a>

                <a href="/booking"
                    class="text-white font-semibold hover:text-orange-300">
                    Booking
                </a>

                <a href="/cart"
                    class="flex items-center gap-2 text-white font-semibold hover:text-orange-300">

                    <span>&#128722; Keranjang</span>

                    <span class="flex min-w-6 h-6 items-center justify-center rounded-full bg-orange-600 px-1.5 text-xs font-bold text-white">
                        {{ $cartCount }}
                    </span>

                </a>

                <a href="/orders"
                    class="text-white font-semibold hover:text-orange-300">
                    Pesanan Saya
                </a>

            @endif

            <form action="/logout" method="POST">
                @csrf

                <button
                    type="submit"
                    class="text-white font-semibold hover:text-orange-300">
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>
