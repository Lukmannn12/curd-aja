<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $query = Produk::with('user');

    // Search
    if ($request->filled('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('sort_harga')) {
        $query->orderBy('harga', $request->sort_harga); // asc / desc
    }

    // Filter berdasarkan stok
    if ($request->filled('filter_stok')) {
        if ($request->filter_stok == 'habis') {
            $query->where('stok', 0); // stok habis = 0
        } elseif ($request->filter_stok == 'hampir') {
            $query->where('stok', '<', 10)->where('stok', '>', 0); // hampir habis
        } elseif ($request->filter_stok == 'tersedia') {
            $query->where('stok', '>=', 1); // stok tersedia
        }
    }

    $perPage = $request->input('perPage', 5);

    // Pagination
    $produks = $query->paginate($perPage)->appends($request->query());

    return view('admin.produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer',
        ]);

        $user = Auth::user();

        Produk::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $produk = Produk::findOrFail($produk->id);
        return view('admin.produk.update', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer',
        ]);

        $produk->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk deleted successfully.');
    }
}
