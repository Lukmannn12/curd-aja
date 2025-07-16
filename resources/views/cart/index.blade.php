<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Keranjang Belanja
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($carts as $cart)
                <div class="bg-white p-4 rounded shadow mb-3 flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold">{{ $cart->produk->nama }}</h3>
                        <p class="text-sm text-gray-600">Qty: {{ $cart->quantity }}</p>
                        <p class="text-sm text-gray-600">Rp {{ number_format($cart->produk->harga, 0, ',', '.') }}</p>
                    </div>
                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 hover:text-red-700" type="submit">Hapus</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
