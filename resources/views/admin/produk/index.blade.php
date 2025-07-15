<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Tombol Tambah --}}
                    <a href="{{ route('produk.create') }}"
                        class="inline-block mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-xs">
                        + Tambah Produk
                    </a>

                    {{-- Tabel Produk --}}
                    <div class="overflow-x-auto">
                        {{-- Filter & Search --}}
                        <form method="GET" class="mb-4 flex flex-wrap gap-2 items-center">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari produk..." class="rounded border-gray-300 px-4 py-2 shadow-sm text-xs">

                            {{-- Dropdown Sort Harga --}}
                            <select name="sort_harga" class="rounded border-gray-300 pr-10 py-2 text-xs">
                                <option value="">Urutkan Harga</option>
                                <option value="asc" {{ request('sort_harga')=='asc' ? 'selected' : '' }}>Termurah
                                </option>
                                <option value="desc" {{ request('sort_harga')=='desc' ? 'selected' : '' }}>Termahal
                                </option>
                            </select>

                            <select name="filter_stok" class="rounded border-gray-300 pr-10 py-2 text-xs">
                                <option value="">Filter Stok</option>
                                <option value="habis" {{ request('filter_stok')=='habis' ? 'selected' : '' }}>Stok Habis
                                </option>
                                <option value="hampir" {{ request('filter_stok')=='hampir' ? 'selected' : '' }}>Stok
                                    &lt; 10</option>
                                <option value="tersedia" {{ request('filter_stok')=='tersedia' ? 'selected' : '' }}>Stok
                                    Tersedia</option>
                            </select>

                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-xs">
                                Terapkan
                            </button>
                        </form>
                        <table class="min-w-full border border-gray-300 rounded-md shadow-sm">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">No
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nama
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Harga
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Stok
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                                        Dibuat oleh</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-800">
                                @forelse ($produks as $produk)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-3 font-medium">{{ $produk->nama }}</td>
                                    <td class="px-6 py-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-3">{{ $produk->stok }}</td>
                                    <td class="px-6 py-3">{{ $produk->user->name ?? '-' }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <a href="{{ route('produk.edit', $produk) }}"
                                            class="text-blue-600 hover:underline">Edit</a>

                                        <form action="{{ route('produk.destroy', $produk) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline ml-2">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data produk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>