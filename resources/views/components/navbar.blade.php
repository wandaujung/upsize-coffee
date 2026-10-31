@php
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';

    $cartCount = auth()->check() && !$isAdmin
        ? (int) \App\Models\Cart::where('user_id', auth()->id())->sum('quantity')
        : 0;

    if ($isAdmin) {
        $navLinks = [
            ['href' => '/admin/dashboard', 'label' => 'Statistik Penjualan'],
            ['href' => '/admin/products', 'label' => 'Kelola Produk'],
            ['href' => '/admin/bookings', 'label' => 'Kelola Booking'],
            ['href' => '/admin/rooms', 'label' => 'Kelola Ruangan'],
            ['href' => '/admin/orders', 'label' => 'Kelola Pesanan'],
        ];
    } else {
        $navLinks = [
            ['href' => '/', 'label' => 'Home'],
            ['href' => '/menu', 'label' => 'Menu'],
            ['href' => '/booking', 'label' => 'Booking'],
        ];

        if (auth()->check()) {
            $navLinks[] = ['href' => '/cart', 'label' => 'Keranjang'];
            $navLinks[] = ['href' => '/orders', 'label' => 'Pesanan Saya'];
        }
    }
@endphp

<nav class="fixed top-0 left-0 z-50 w-full bg-black/40 backdrop-blur-md shadow-md">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6">

        <a href="/" class="flex min-w-0 items-center gap-2 sm:gap-3">
            <span class="shrink-0 text-xl">&#9749;</span>
            <span class="truncate text-lg font-bold text-white sm:text-2xl">
                UpSize Coffee
            </span>
        </a>

        <div class="hidden shrink-0 items-center gap-5 xl:flex">

            @foreach ($navLinks as $link)
                <a href="{{ $link['href'] }}"
                   class="flex items-center gap-2 whitespace-nowrap font-semibold text-white hover:text-orange-300">

                    @if ($link['href'] === '/cart')
                        <span>&#128722; Keranjang</span>
                        <span class="flex h-6 min-w-6 items-center justify-center rounded-full bg-orange-600 px-1.5 text-xs font-bold text-white">
                            {{ $cartCount }}
                        </span>
                    @else
                        {{ $link['label'] }}
                    @endif

                </a>
            @endforeach

            @auth
                <form action="/logout" method="POST">
                    @csrf

                    <button type="submit"
                            class="whitespace-nowrap font-semibold text-white hover:text-orange-300">
                        Logout
                    </button>
                </form>
            @else
                <a href="/login"
                   class="font-semibold text-white hover:text-orange-300">
                    Login
                </a>

                <a href="/register"
                   class="rounded-lg bg-orange-600 px-4 py-2 font-semibold text-white hover:bg-orange-700">
                    Daftar
                </a>
            @endauth

        </div>

        <details class="group relative shrink-0 xl:hidden">

            <summary aria-label="Buka menu navigasi"
                     class="flex cursor-pointer list-none items-center gap-2 rounded-lg border border-white/30 px-3 py-2 text-white [&::-webkit-details-marker]:hidden">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="24"
                     height="24"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     aria-hidden="true">
                    <line x1="4" y1="6" x2="20" y2="6"></line>
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                    <line x1="4" y1="18" x2="20" y2="18"></line>
                </svg>

                <span class="hidden text-sm font-semibold sm:inline">
                    Menu
                </span>

            </summary>

            <div class="absolute right-0 top-full mt-3 w-64 max-w-[calc(100vw-2rem)] rounded-xl border border-white/10 bg-gray-900 p-3 shadow-2xl">

                <div class="flex flex-col gap-1">

                    @foreach ($navLinks as $link)
                        <a href="{{ $link['href'] }}"
                           class="flex items-center justify-between rounded-lg px-4 py-3 font-semibold text-white hover:bg-gray-800 hover:text-orange-300">

                            @if ($link['href'] === '/cart')
                                <span>&#128722; Keranjang</span>

                                <span class="flex h-6 min-w-6 items-center justify-center rounded-full bg-orange-600 px-1.5 text-xs font-bold text-white">
                                    {{ $cartCount }}
                                </span>
                            @else
                                <span>{{ $link['label'] }}</span>
                            @endif

                        </a>
                    @endforeach

                    <div class="my-2 border-t border-white/20"></div>

                    @auth
                        <form action="/logout" method="POST">
                            @csrf

                            <button type="submit"
                                    class="w-full rounded-lg px-4 py-3 text-left font-semibold text-white hover:bg-gray-800 hover:text-orange-300">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="/login"
                           class="rounded-lg px-4 py-3 font-semibold text-white hover:bg-gray-800">
                            Login
                        </a>

                        <a href="/register"
                           class="rounded-lg bg-orange-600 px-4 py-3 text-center font-semibold text-white hover:bg-orange-700">
                            Daftar Sekarang
                        </a>
                    @endauth

                </div>

            </div>

        </details>

    </div>
</nav>
