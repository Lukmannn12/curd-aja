<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <!-- Pilih Produk -->
                    <div class="mb-4">
                        <label for="produk_id" class="block text-sm font-medium text-gray-700">Produk</label>
                        <select name="produk_id" id="produk_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($produks as $produk)
                            <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                            @endforeach
                        </select>
                        @error('produk_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-4">
                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        @error('jumlah') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Total Harga (otomatis dari harga produk x jumlah) -->
                    <!-- Total Harga (readonly) tampil ke user -->
                    <div class="mb-4">
                        <label for="total_harga_view" class="block text-sm font-medium text-gray-700">Total
                            Harga</label>
                        <input type="text" id="total_harga_view"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" readonly>
                    </div>

                    <!-- Total Harga yang dikirim ke server -->
                    <input type="hidden" id="total_harga" name="total_harga">
                    <!-- Tombol Submit -->
                    <div class="flex justify-end">
                        <a href="{{ route('transaksi.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const produkSelect = document.getElementById('produk_id');
    const jumlahInput = document.getElementById('jumlah');
    const totalHargaView = document.getElementById('total_harga_view');
    const totalHargaHidden = document.getElementById('total_harga');

    const produkHargaMap = {
        @foreach($produks as $produk)
            {{ $produk->id }}: {{ $produk->harga }},
        @endforeach
    };

    function updateTotalHarga() {
        const produkId = produkSelect.value;
        const jumlah = parseInt(jumlahInput.value) || 0;
        const harga = produkHargaMap[produkId] || 0;
        const total = jumlah * harga;

        totalHargaView.value = 'Rp ' + total.toLocaleString('id-ID');
        totalHargaHidden.value = total;
    }

    produkSelect.addEventListener('change', updateTotalHarga);
    jumlahInput.addEventListener('input', updateTotalHarga);
    </script>


</x-app-layout>