@extends('template.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Penjualan Berhasil!</h4>
            </div>
            <div class="card-body">
                <p><strong>Kode Pembayaran:</strong> {{ $penjualan->kode_pembayaran }}</p>
                <p><strong>Tanggal Penjualan:</strong> {{ $penjualan->tanggal_penjualan }}</p>
                <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Umum' }}</p>
                <p><strong>Produk:</strong>
                    <ul>
                        @foreach(json_decode($penjualan->produk_id) as $produk)
                            <li>{{ $produk->nama }} ({{ $produk->jumlah }}x) - Rp {{ number_format($produk->harga, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                </p>
                <p><strong>Metode Pembayaran:</strong> {{ ucfirst(str_replace('_', ' ', $penjualan->metode_pembayaran)) }}</p>
                <p><strong>Total Harga:</strong> Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</p>
                <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($penjualan->jumlah_bayar, 0, ',', '.') }}</p>
                <p><strong>Kembalian:</strong> Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</p>
                <p><strong>Status Pembayaran:</strong> 
                    @if($penjualan->status == 'paid')
                        <span class="badge bg-success">Lunas</span>
                    @elseif($penjualan->status == 'pending')
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    @else
                        <span class="badge bg-danger">Gagal</span>
                    @endif
                </p>
                <a href="{{ route('penjualans.index') }}" class="btn btn-primary">Kembali ke Daftar Penjualan</a>
            </div>
        </div>
    </div>
@endsection
