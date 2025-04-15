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
        background-color: #007bff;
        color: white;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        width: 100%;
    }
    .btn-custom:hover {
        background-color: #0056b3;
        transform: scale(1.02);
    }
</style>

<div class="content-wrapper">
    <div class="form-container">
        <h1><i class="bi bi-pencil-square"></i> Edit Pelanggan</h1>
        <form action="{{ route('pelanggans.update', $pelanggan->pelanggan_id) }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            
            <div class="form-group mb-3">
                <label for="nama_pelanggan"><i class="bi bi-person"></i> Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" value="{{ $pelanggan->nama_pelanggan }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="alamat"><i class="bi bi-geo-alt"></i> Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $pelanggan->alamat }}" required>
            </div>

            <div class="form-group mb-4">
                <label for="nomor_telepon"><i class="bi bi-telephone"></i> Nomor Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" value="{{ $pelanggan->nomor_telepon }}" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="col-md-6">
    <button type="submit" class="btn btn-primary w-100" style="background-color: #007bff; border: none; font-weight: bold; transition: 0.3s;">
        <i class="bi bi-save"></i> Update
    </button>
</div>
@endsection

