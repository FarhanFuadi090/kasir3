@extends('template')

@section('content')

<!-- Bootstrap 5 & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body {
        background-color: #f5f7fa;
        font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
    }
    .main-container {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-top: 30px;
        margin-bottom: 30px;
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f0f0f0;
    }
    .page-title {
        font-weight: 700;
        color: #333;
        font-size: 24px;
        margin: 0;
    }
    .btn-add {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11);
    }
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, 0.18);
    }
    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
    }
    .table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border-top: none;
        padding: 16px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table td {
        padding: 16px;
        vertical-align: middle;
        border-color: #f0f0f0;
        font-size: 15px;
    }
    .table tr:hover {
        background-color: #f9fafc;
    }
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: none;
    }
    .btn-view {
        background-color: #e3f2fd;
        color: #0d6efd;
    }
    .btn-edit {
        background-color: #fff8e1;
        color: #ffa000;
    }
    .btn-delete {
        background-color: #ffebee;
        color: #f44336;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        filter: brightness(95%);
    }
    .alert {
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
        border-left: 4px solid;
    }
    .alert-success {
        background-color: #e8f5e9;
        border-color: #4caf50;
        color: #2e7d32;
    }
    .no-data {
        padding: 40px;
        text-align: center;
        color: #6c757d;
    }
    .no-data i {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }
    .badge-phone {
        background-color: #f5f5f5;
        padding: 6px 12px;
        border-radius: 30px;
        font-weight: 500;
        color: #555;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .table-responsive {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="container main-container">
    <div class="page-header">
        <h1 class="page-title"><i class="fas fa-users"></i> Daftar Pelanggan</h1>
    </div>
    <!-- rest of your content -->

        <a href="{{ route('pelanggans.create') }}" class="btn btn-success btn-add">
            <i class="bi bi-person-plus-fill me-2"></i> Tambah Pelanggan
        </a>
    </div>

    <!-- Input Pencarian -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari pelanggan...">
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody id="pelangganTable">
                @forelse ($pelanggans as $pelanggan)
                    <tr class="pelanggan-row">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="nama-pelanggan">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-light rounded-circle text-center me-3" style="width: 40px; height: 40px; line-height: 40px;">
                                    {{ substr($pelanggan->nama_pelanggan, 0, 1) }}
                                </div>
                                <span class="fw-medium">{{ $pelanggan->nama_pelanggan }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt text-muted me-2"></i>
                                {{ $pelanggan->alamat }}
                            </div>
                        </td>
                        <td>
                            <span class="badge-phone">
                                <i class="bi bi-telephone"></i>
                                {{ $pelanggan->nomor_telepon }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('pelanggans.show', $pelanggan->pelanggan_id) }}" class="btn btn-view btn-action" data-bs-toggle="tooltip" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('pelanggans.edit', $pelanggan->pelanggan_id) }}" class="btn btn-edit btn-action" data-bs-toggle="tooltip" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('pelanggans.destroy', $pelanggan->pelanggan_id) }}" method="POST" class="d-inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn btn-delete btn-action" data-bs-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="no-data">
                            <i class="bi bi-people"></i>
                            <p>Tidak ada data pelanggan saat ini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll(".pelanggan-row");

        rows.forEach(row => {
            let nama = row.querySelector(".nama-pelanggan").innerText.toLowerCase();
            row.style.display = nama.includes(searchValue) ? "" : "none";
        });
    });
</script>

@endsection
