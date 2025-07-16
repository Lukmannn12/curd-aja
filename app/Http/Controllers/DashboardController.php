<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalProduk = Produk::count();
        $totalTransaksi = Transaksi::count();
        $totalUser = User::count();
        $users = User::select('name', 'role')->get();
        // Ambil total penghasilan per bulan
        $penghasilanPerBulan = Transaksi::select(
            DB::raw("DATE_FORMAT(created_at, '%M %Y') as bulan"),
            DB::raw("SUM(total_harga) as total")
        )
            ->groupBy('bulan')
            ->orderByRaw("MIN(created_at)")
            ->get();

        return view('dashboard', compact('totalProduk', 'totalTransaksi', 'users', 'totalUser', 'penghasilanPerBulan'));
    }

    public function home()
    {
        $produk = Produk::all();
        return view('welcome', compact('produk'));
    }
}
