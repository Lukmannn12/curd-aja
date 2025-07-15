<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with('user', 'produk')->latest()->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::all();
        return view('admin.transaksi.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'produk_id' => 'required|exists:produks,id',
        'jumlah' => 'required|integer|min:1',
        'total_harga' => 'required|numeric|min:0',
    ]);

    $user = Auth::user();
    $produk = Produk::findOrFail($request->produk_id);
    $total_harga = $produk->harga * $request->jumlah;

    // Optional: validasi silang antara yang dikirim vs yang dihitung ulang
    if ($total_harga != $request->total_harga) {
        return back()->withErrors(['total_harga' => 'Total harga tidak sesuai.'])->withInput();
    }

    Transaksi::create([
        'user_id' => $user->id,
        'produk_id' => $request->produk_id,
        'jumlah' => $request->jumlah,
        'total_harga' => $total_harga,
    ]);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
