@extends('template')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-lg border-0 rounded-lg p-4">
                <h3 class="text-center text-warning mb-4"><i class="fas fa-edit"></i> Edit Produk</h3>
                <form action="{{ route('produks.update', $produk->produk_id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="form-group">
                        <label for="nama_produk" class="font-weight-bold"><i class="fas fa-tag"></i> Nama Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" class="form-control rounded-pill" 
                               value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="gambar" class="font-weight-bold"><i class="fas fa-image"></i> Gambar Produk</label>
                        <div class="custom-file">
                            <input type="file" name="gambar" class="custom-file-input" id="gambar" onchange="previewImage(event)">
                            <label class="custom-file-label" for="gambar">Pilih gambar...</label>
                        </div>
                        @if($produk->gambar)
                            <img id="imagePreview" src="{{ asset('storage/'.$produk->gambar) }}" class="img-fluid mt-3" style="max-height: 200px; border-radius: 10px;">
                        @else
                            <img id="imagePreview" src="#" class="img-fluid mt-3 d-none" style="max-height: 200px; border-radius: 10px;">
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="harga" class="font-weight-bold"><i class="fas fa-money-bill-wave"></i> Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" name="harga" id="harga" class="form-control rounded-right" 
                                   value="{{ old('harga', $produk->harga) }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="stok" class="font-weight-bold"><i class="fas fa-boxes"></i> Stok</label>
                        <input type="number" name="stok" id="stok" class="form-control rounded-pill" 
                               value="{{ old('stok', $produk->stok) }}" required>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-block rounded-pill"><i class="fas fa-save"></i> Perbarui</button>
                    <a href="{{ route('produks.index') }}" class="btn btn-secondary btn-block rounded-pill"><i class="fas fa-arrow-left"></i> Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function(){
            const imgElement = document.getElementById('imagePreview');
            imgElement.src = reader.result;
            imgElement.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
</script>

@endsection
