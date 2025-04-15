<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container">
        <h1>Detail Pelanggan</h1>
        <table class="table">
            <tr>
                <th>Nama</th>
                <td>{{ $pelanggan->nama_pelanggan }}</td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td>{{ $pelanggan->nomor_telepon }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $pelanggan->alamat }}</td>
            </tr>
        </table>
        <a href="{{ route('pelanggans.index') }}" class="btn btn-primary">Kembali</a>
    </div>

