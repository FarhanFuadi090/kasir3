@extends('template.app')

@section('content')
    <div class="container">
        <h2>Pelanggan Berhasil Ditambahkan!</h2>
        <p>Nama: {{ $pelanggan->nama_pelanggan }}</p>
        <p>Alamat: {{ $pelanggan->alamat }}</p>
        <p>Nomor Telepon: {{ $pelanggan->nomor_telepon }}</p>
        <a href="{{ route('pelanggans.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
    </div>
@endsection
