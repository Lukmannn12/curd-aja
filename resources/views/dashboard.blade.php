<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center space-x-2 text-md text-gray-600 font-semibold" id="clock-container">
                <!-- Ikon Jam -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6l4 2m4-2a8 8 0 11-16 0 8 8 0 0116 0z" />
                </svg>
                <!-- Jam -->
                <span id="clock"></span>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Kolom Kiri: Card Statistik -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            {{-- Card Statistik --}}
                            <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
                                <div>
                                    <div class="text-gray-500 text-sm mb-1">Total Produk</div>
                                    <div class="text-3xl font-bold text-gray-800">{{ $totalProduk }}</div>
                                </div>
                                <div class="text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 7l-8-4-8 4m16 0v8a2 2 0 01-1 1.73l-7 4-7-4A2 2 0 014 15V7m16 0L12 11M4 7l8 4" />
                                    </svg>
                                </div>
                            </div>

                            <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
                                <div>
                                    <div class="text-gray-500 text-sm mb-1">Total Transaksi</div>
                                    <div class="text-3xl font-bold text-gray-800">{{ $totalTransaksi }}</div>
                                </div>
                                <div class="text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V5a2 2 0 012-2h5l2 2h4a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
                                <div>
                                    <div class="text-gray-500 text-sm mb-1">Total User</div>
                                    <div class="text-3xl font-bold text-gray-800">{{ $totalUser }}</div>
                                </div>
                                <div class="text-purple-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Kalender -->
                        <div class="bg-white shadow rounded-lg p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kalender Bulanan</h2>
                            <div id="calendar" class="text-sm text-gray-700">
                                <!-- Kalender akan dirender oleh JS -->
                            </div>
                        </div>
                    </div>
                    {{-- Tabel User --}}
                    <div class="mt-10 bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Daftar Pengguna</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                                    <tr>
                                        <th class="px-6 py-3 text-left">No</th>
                                        <th class="px-6 py-3 text-left">Nama</th>
                                        <th class="px-6 py-3 text-left">Role</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-gray-700">
                                    @forelse ($users as $index => $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $user->role }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="px-6 py-4" colspan="2">Tidak ada data pengguna.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Grafik Penghasilan Per Bulan --}}
                    <div class="mt-10 bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik Penghasilan per Bulan</h3>
                        <div id="chart-penghasilan"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
        Highcharts.chart('chart-penghasilan', {
            accessibility: {
            enabled: false
            },
            chart: {
                type: 'column',
            },
            title: {
                text: 'Penghasilan per Bulan'
            },
            xAxis: {
                categories: [
                    @foreach($penghasilanPerBulan as $item)
                        '{{ $item->bulan }}',
                    @endforeach
                ],
                crosshair: true
            },
            yAxis: {
                title: {
                    text: 'Total Penghasilan (Rp)'
                }
            },
            tooltip: {
                valuePrefix: 'Rp '
            },
            series: [{
                name: 'Penghasilan',
                data: [
                    @foreach($penghasilanPerBulan as $item)
                        {{ $item->total }},
                    @endforeach
                ],
                color: '#38bdf8' // warna biru cerah
            }]
        });
    });
    </script>

    <script>
        function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        document.getElementById('clock').textContent = timeString;
    }

    setInterval(updateClock, 1000);
    updateClock(); // jalankan langsung saat halaman dimuat
    </script>

    <script>
        function generateCalendar() {
        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth();

        const firstDay = new Date(year, month, 1).getDay(); // 0: Minggu
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const calendarDiv = document.getElementById('calendar');

        let html = `
            <div class="text-center mb-2 font-semibold text-gray-800">
                ${monthNames[month]} ${year}
            </div>
            <div class="grid grid-cols-7 text-center font-bold text-gray-600 mb-1">
                <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
            </div>
            <div class="grid grid-cols-7 text-center gap-1 text-sm">
        `;

        // Blank cells before first day
        for (let i = 0; i < firstDay; i++) {
            html += `<div class="p-2"></div>`;
        }

        // Days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const isToday = day === today.getDate();
            html += `
                <div class="p-2 rounded ${isToday ? 'bg-blue-600 text-white font-bold' : 'hover:bg-gray-100'}">
                    ${day}
                </div>`;
        }

        html += `</div>`; // close grid
        calendarDiv.innerHTML = html;
    }

    generateCalendar();
    </script>

</x-app-layout>