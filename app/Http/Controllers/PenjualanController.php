<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Pelanggan;
use App\Produk;
use PDF;
use DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with(['pelanggan', 'produk'])->orderBy('tanggal_penjualan', 'desc')->get();
        return view('penjualans.index', compact('penjualans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        return view('penjualans.create', compact('pelanggans', 'produks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'nullable|exists:pelanggans,pelanggan_id',
            'produk_id' => 'required|array|min:1',
            'produk_id.*' => 'exists:produks,produk_id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:cash,transfer,credit_card,e_wallet',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        DB::beginTransaction();
        try {
            $totalBayar = 0;
            $produkTerpilih = [];
    
            foreach ($request->produk_id as $key => $produk_id) {
                $produk = Produk::findOrFail($produk_id);
                $jumlah = $request->jumlah[$key];
    
                if ($produk->stok < $jumlah) {
                    return redirect()->back()->with('error', "Stok produk {$produk->nama_produk} tidak mencukupi")->withInput();
                }
    
                // Kurangi stok produk
                $produk->stok -= $jumlah;
                $produk->save();
    
                // Hitung total bayar
                $subtotal = $produk->harga * $jumlah;
                $totalBayar += $subtotal;
    
                // Simpan produk dalam array
                $produkTerpilih[] = [
                    'produk_id' => $produk->produk_id,
                    'nama_produk' => $produk->nama_produk,
                    'jumlah' => $jumlah,
                    'harga' => $produk->harga,
                    'subtotal' => $subtotal,
                ];
            }
    
            if ($request->jumlah_bayar < $totalBayar) {
                return redirect()->back()->with('error', "Jumlah bayar tidak mencukupi. Total harus Rp " . number_format($totalBayar, 0, ',', '.'))->withInput();
            }
    
            // Simpan transaksi ke tabel penjualans
            $penjualan = Penjualan::create([
                'pelanggan_id' => $request->pelanggan_id,
                'produk_id' => json_encode($produkTerpilih), // Simpan sebagai JSON
                'kode_pembayaran' => $this->generateKodePembayaran(),
                'tanggal_penjualan' => Carbon::now(),
                'total_bayar' => $totalBayar,
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian' => $request->jumlah_bayar - $totalBayar,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => ($request->jumlah_bayar >= $totalBayar) ? 'paid' : 'pending',
            ]);
    
            DB::commit();
            return redirect()->route('penjualans.index')->with('success', 'Transaksi berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    

    public function edit($id)
{
    $penjualan = Penjualan::find($id);
    if (!$penjualan) {
        return redirect()->route('penjualans.index')->with('error', 'Transaksi tidak ditemukan');
    }

    $pelanggans = Pelanggan::all();
    $produks = Produk::all();

    // Pastikan produk_id berupa array, jika tidak, jadikan array kosong
    $produkList = json_decode($penjualan->produk_id, true) ?? [];

    return view('penjualans.edit', compact('penjualan', 'pelanggans', 'produks', 'produkList'));
}
    
    public function update(Request $request, $id)
{
    $penjualan = Penjualan::find($id);
    if (!$penjualan) {
        return redirect()->route('penjualans.index')->with('error', 'Transaksi tidak ditemukan');
    }

    $validator = Validator::make($request->all(), [
        'pelanggan_id' => 'nullable|exists:pelanggans,pelanggan_id',
        'produk_id' => 'required|array|min:1',
        'produk_id.*' => 'exists:produks,produk_id',
        'jumlah' => 'required|array|min:1',
        'jumlah.*' => 'required|integer|min:1',
        'jumlah_bayar' => 'required|numeric|min:0',
        'metode_pembayaran' => 'required|in:cash,transfer,credit_card,e_wallet',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    DB::beginTransaction();
    try {
        // Kembalikan stok produk lama
        $produkLama = json_decode($penjualan->produk_id, true);
        if ($produkLama) {
            foreach ($produkLama as $item) {
                $produk = Produk::find($item['produk_id']);
                if ($produk) {
                    $produk->stok += $item['jumlah'];
                    $produk->save();
                }
            }
        }

        $totalBayar = 0;
        $produkTerpilih = [];

        foreach ($request->produk_id as $key => $produk_id) {
            $produk = Produk::findOrFail($produk_id);
            $jumlah = $request->jumlah[$key];

            if ($produk->stok < $jumlah) {
                return redirect()->back()->with('error', "Stok produk {$produk->nama_produk} tidak mencukupi")->withInput();
            }

            // Kurangi stok produk
            $produk->stok -= $jumlah;
            $produk->save();

            // Hitung total bayar
            $subtotal = $produk->harga * $jumlah;
            $totalBayar += $subtotal;

            // Simpan produk dalam array
            $produkTerpilih[] = [
                'produk_id' => $produk->produk_id,
                'nama_produk' => $produk->nama_produk,
                'jumlah' => $jumlah,
                'harga' => $produk->harga,
                'subtotal' => $subtotal,
            ];
        }

        if ($request->jumlah_bayar < $totalBayar) {
            return redirect()->back()->with('error', "Jumlah bayar tidak mencukupi. Total harus Rp " . number_format($totalBayar, 0, ',', '.'))->withInput();
        }

        // Update transaksi ke tabel penjualans
        $penjualan->pelanggan_id = $request->pelanggan_id;
        $penjualan->produk_id = json_encode($produkTerpilih); // Simpan sebagai JSON
        $penjualan->tanggal_penjualan = Carbon::now();
        $penjualan->total_bayar = $totalBayar;
        $penjualan->jumlah_bayar = $request->jumlah_bayar;
        $penjualan->kembalian = $request->jumlah_bayar - $totalBayar;
        $penjualan->metode_pembayaran = $request->metode_pembayaran;
        $penjualan->status = ($request->jumlah_bayar >= $totalBayar) ? 'paid' : 'pending';
        $penjualan->save();

        DB::commit();
        return redirect()->route('penjualans.index')->with('success', 'Transaksi berhasil diperbarui');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
    }
}

public function show($id)
{
    $penjualan = Penjualan::findOrFail($id);

    // Decode produk_id dengan default array kosong
    $produkList = json_decode($penjualan->produk_id, true) ?? [];

    // Pastikan array tidak kosong sebelum query
    if (!empty($produkList)) {
        $produks = Produk::whereIn('produk_id', array_keys($produkList))->get();

        // Tambahkan jumlah (qty) ke objek produk
        foreach ($produks as $produk) {
            $produk->jumlah = $produkList[$produk->produk_id]['jumlah'];
        }
    } else {
        $produks = collect(); // Kosongkan jika tidak ada produk
    }

    return view('penjualans.show', compact('penjualan', 'produks'));
}
public function cetakStruk($id)
{
    $penjualan = Penjualan::find($id);

    if (!$penjualan) {
        return redirect()->back()->with('error', 'Data penjualan tidak ditemukan');
    }

    return view('struk', compact('penjualan'));
}



    public function generateKodePembayaran()
    {
        return 'PAY-' . strtoupper(uniqid());
    }

    public function destroy($id)
{
    $penjualan = Penjualan::find($id);
    if (!$penjualan) {
        return redirect()->route('penjualans.index')->with('error', 'Transaksi tidak ditemukan');
    }

    DB::beginTransaction();
    try {
        // Kembalikan stok produk sebelum menghapus transaksi
        $produkLama = json_decode($penjualan->produk_id, true);
        if ($produkLama) {
            foreach ($produkLama as $item) {
                $produk = Produk::find($item['produk_id']);
                if ($produk) {
                    $produk->stok += $item['jumlah'];
                    $produk->save();
                }
            }
        }

        // Hapus transaksi
        $penjualan->delete();

        DB::commit();
        return redirect()->route('penjualans.index')->with('success', 'Transaksi berhasil dihapus');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}



public function laporan(Request $request)
{
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalAkhir = $request->input('tanggal_akhir');

    $query = DB::table('penjualans'); // or Penjualan::query() if you're using Eloquent

    if ($tanggalMulai && $tanggalAkhir) {
        $query->whereDate('created_at', '>=', $tanggalMulai)
              ->whereDate('created_at', '<=', $tanggalAkhir);
    } elseif ($tanggalMulai) {
        $query->whereDate('created_at', '=', $tanggalMulai);
    } else {
        $query->whereDate('created_at', '=', date('Y-m-d'));
    }

    // Fetch the penjualans
    $penjualans = $query->orderBy('created_at', 'desc')->get();

    // Calculate the subtotal
    $subtotal = $penjualans->sum('total_bayar');

    // Return the view with the necessary variables
    return view('laporans.index', compact('penjualans', 'tanggalMulai', 'tanggalAkhir', 'subtotal'));
}
public function getTotalPenjualan()
    {
        $totalPenjualan = Penjualan::count();
        return response()->json(['totalPenjualan' => $totalPenjualan]);
    }

}