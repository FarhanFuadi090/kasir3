@extends('template')

@section('content')

<!-- Bootstrap 5 & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    body {
        background-color: #f8f9fa;
    }
    .content-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding-top: 20px;
    }
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
    }
    h1 {
        text-align: center;
        color: #343a40;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .form-group label {
        font-weight: bold;
    }
    .btn-custom {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        width: 100%;
    }
    .btn-custom:hover {
        background-color: #218838;
        transform: scale(1.02);
    }
</style>

<div class="content-wrapper">
    <div class="form-container">
        <h1><i class="bi bi-person-plus-fill"></i> Tambah Pelanggan</h1>
        <form action="{{ route('pelanggans.store') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group mb-3">
                <label for="nama_pelanggan"><i class="bi bi-person"></i> Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan nama pelanggan" required>
            </div>

            <div class="form-group mb-3">
                <label for="alamat"><i class="bi bi-geo-alt"></i> Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat pelanggan" required>
            </div>

            <div class="form-group mb-4">
                <label for="nomor_telepon"><i class="bi bi-telephone"></i> Nomor Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" placeholder="Masukkan nomor telepon" required>
            </div>
            <div class="row">
    <div class="col-md-12 text-center">
        <a href="{{ route('penjualans.index') }}" class="btn btn-secondary px-4 py-2 me-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success px-4 py-2">
            <i class="bi bi-save"></i> Simpan
        </button>
    </div>
</div>
@endsection