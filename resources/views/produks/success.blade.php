@extends('template.app')

@section('content')
    <div class="container">
        <h2>Detail Produk Berhasil Ditambahkan!</h2>
        <p>ID Produk: {{ $produk->id }}</p>
        <p>Nama Produk: {{ $produk->nama_produk }}</p>
        <p>Harga: Rp {{ number_format($produk->harga, 2, ',', '.') }}</p>
        <p>Stok: {{ $produk->stok }}</p>
        ($produk->gambar)
            <p>Gambar Produk:</p>
            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" width="200">
        <a href="{{ route('produks.index') }}" class="btn btn-primary">Kembali ke Daftar Produk</a>
    </div>
@endsection
