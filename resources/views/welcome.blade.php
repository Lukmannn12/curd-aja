<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800">
    <!-- Alert Success / Error -->
    @if (session('success') || session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-4 right-4 z-50 max-w-sm w-full rounded shadow-lg
                {{ session('success') ? 'bg-green-500' : 'bg-red-500' }}
                text-white px-4 py-3">
        <div class="flex items-center justify-between">
            <span>
                {{ session('success') ?? session('error') }}
            </span>
            <button @click="show = false" class="text-white ml-4 font-bold">&times;</button>
        </div>
    </div>
    @endif


    <div class="bg-white">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto"
                            src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                            alt="" />
                    </a>
                </div>

                <!-- Button open menu -->
                <div class="flex lg:hidden">
                    <button type="button" aria-label="Open main menu"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                <div class="hidden lg:flex lg:gap-x-12">
                    <a href="#" class="text-sm font-semibold text-gray-900">Product</a>
                    <a href="#" class="text-sm font-semibold text-gray-900">Features</a>
                    <a href="#" class="text-sm font-semibold text-gray-900">Marketplace</a>
                    <a href="#" class="text-sm font-semibold text-gray-900">Company</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center gap-4">
                    @auth
                    @php
                    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                    @endphp

                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-indigo-600">
                        🛒
                        @if ($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-1.5 rounded-full">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>

                    <!-- Greeting -->
                    <span class="text-sm font-semibold text-gray-900">Hello, {{ Auth::user()->name }}</span>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm font-semibold text-gray-900 hover:text-red-600 transition duration-150 ease-in-out">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900">
                        Log in <span aria-hidden="true">&rarr;</span>
                    </a>
                    @endauth
                </div>
            </nav>

            <!-- Mobile menu -->
            <div class="lg:hidden hidden" role="dialog" aria-modal="true">
                <div class="fixed inset-0 z-50 bg-black/20"></div>
                <div
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-8 w-auto"
                                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                                alt="" />
                        </a>
                        <!-- Button close menu -->
                        <button type="button" aria-label="Close menu" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Product</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Features</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Marketplace</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Company</a>
                            </div>
                            <div class="py-6">
                                @auth
                                <span class="block px-3 py-2.5 text-base font-semibold text-gray-900">
                                    Hello, {{ Auth::user()->name }}
                                </span>
                                @else
                                <a href="{{ route('login') }}"
                                    class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50">
                                    Log in
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-1155/678 w-144.5 -translate-x-1/2 rotate-30 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-288.75"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div
                        class="relative rounded-full px-3 py-1 text-sm/6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Announcing our next round of funding. <a href="#" class="font-semibold text-indigo-600"><span
                                class="absolute inset-0" aria-hidden="true"></span>Read more <span
                                aria-hidden="true">&rarr;</span></a>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">Data to
                        enrich your online business</h1>
                    <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">Anim aute id magna aliqua
                        ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam
                        occaecat.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="#"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
                            started</a>
                        <a href="#" class="text-sm/6 font-semibold text-gray-900">Learn more <span
                                aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>

            {{-- section 2 --}}
            <div class="bg-white">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    <h2 class="text-2xl font-bold mb-6">Produk Kami</h2>

                    <div
                        class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                        @foreach ($produk as $item)
                        <a href="#" class="group block">
                            <div class="relative">
                                <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/category-page-04-image-card-01.jpg"
                                    alt="{{ $item->nama }}"
                                    class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-7/8" />
                            </div>

                            <!-- Nama Produk -->
                            <h3 class="mt-4 text-sm text-gray-700">{{ $item->nama }}</h3>

                            <!-- Stok Produk -->
                            <p class="text-xs text-gray-500">Stok: {{ $item->stok }}</p>

                            <div class="mt-1 flex items-center justify-between">
                                <!-- Harga -->
                                <p class="text-lg font-medium text-gray-900">Rp {{ number_format($item->harga, 0, ',',
                                    '.') }}</p>

                                <!-- Icon Keranjang -->
                                @auth
                                <!-- Jika user login, tampilkan form -->
                                <form method="POST" action="{{ route('cart.store') }}">
                                    @csrf
                                    <input type="hidden" name="produk_id" value="{{ $item->id }}">
                                    <button type="submit" class="text-gray-600 hover:text-indigo-600">
                                        <!-- Icon keranjang -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m4-9l2 9" />
                                        </svg>
                                    </button>
                                </form>
                                @else
                                <!-- Jika belum login, kasih alert -->
                                <button type="button" onclick="alert('Harap login terlebih dahulu')"
                                    class="text-gray-600 hover:text-indigo-600">
                                    <!-- Icon keranjang -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m4-9l2 9" />
                                    </svg>
                                </button>
                                @endauth
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>



        </div>
    </div>

    <script>
        // Ambil tombol buka menu, tombol tutup menu, dan container menu mobile
        const openMenuBtn = document.querySelector('button[aria-label="Open main menu"]');
        const closeMenuBtn = document.querySelector('button[aria-label="Close menu"]');
        const mobileMenu = document.querySelector('div[role="dialog"]');

        // Fungsi untuk membuka menu
        function openMenu() {
            mobileMenu.classList.remove('hidden');
        }

        // Fungsi untuk menutup menu
        function closeMenu() {
            mobileMenu.classList.add('hidden');
        }

        // Pasang event listener pada tombol buka dan tutup menu
        openMenuBtn.addEventListener('click', openMenu);
        closeMenuBtn.addEventListener('click', closeMenu);

        // Tutup menu jika klik di luar container menu (background overlay)
        mobileMenu.addEventListener('click', (e) => {
            if (e.target === mobileMenu) {
                closeMenu();
            }
        });
    </script>
</body>

</html>