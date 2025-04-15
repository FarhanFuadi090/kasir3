<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Pelanggan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all(); 
        return view('produks.index', compact('produks'));
    }

    public function create()
    {
        return view('produks.create'); 
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk.*.nama_produk' => 'required|string|max:255',
            'produk.*.harga' => 'required|numeric|min:0',
            'produk.*.stok' => 'required|integer|min:0',
            'produk.*.gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $produkData = [];

        foreach ($request->produk as $produk) {
            $gambarPath = null;

            if (isset($produk['gambar']) && is_file($produk['gambar'])) {
                $gambarPath = $produk['gambar']->store('produk_images', 'public');
            }

            $produkData[] = [
                'nama_produk' => $produk['nama_produk'],
                'harga' => str_replace('.', '', $produk['harga']),
                'stok' => $produk['stok'],
                'gambar' => $gambarPath,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        Produk::insert($produkData);

        return redirect()->route('produks.index')->with('success', count($produkData) . ' produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('produks.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $gambarPath = $request->file('gambar')->store('produk_images', 'public');
        } else {
            $gambarPath = $produk->gambar;
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => str_replace('.', '', $request->harga),
            'stok' => $request->stok,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();
        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    }


    public function getTotalProduk()
    {
        try {
            if (!Schema::hasTable('produks')) {
                return response()->json(['error' => 'Tabel produks tidak ditemukan'], 404);
            }
    
            $totalProduk = DB::table('produks')->count();
            return response()->json(['totalProduk' => $totalProduk], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
    