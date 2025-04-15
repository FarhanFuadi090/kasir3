<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Pelanggan;
use App\Penjualan;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Mengambil jumlah produk, penjualan, pengguna, dan total pendapatan
        $productCount = Produk::count();
        $pelangganCount = Pelanggan::count();
        $penjualanCount = Penjualan::count();
        $stokRendah = Produk::where('stok', '<=', 3)->count();
        $totalPendapatan = Penjualan::sum('total_bayar');
          // Pastikan 'total_harga' adalah field yang benar

        // Mengirim data ke tampilan dashboard
        return view('home', compact('productCount', 'pelangganCount', 'penjualanCount', 'stokRendah', 'totalPendapatan'));    }
}