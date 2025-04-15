@extends('template')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-lg p-4">
                <h3 class="text-center text-primary mb-4"><i class="fas fa-box-open"></i> Tambah Produk</h3>
                <form action="{{ route('produks.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <div id="produk-container">
                        <div class="produk-item">
                            <h5 class="text-muted">Produk 1</h5>
                            <div class="form-group">
                                <label class="font-weight-bold"><i class="fas fa-tag"></i> Nama Produk</label>
                                <input type="text" name="produk[0][nama_produk]" class="form-control rounded-pill" placeholder="Masukkan nama produk" required>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold"><i class="fas fa-image"></i> Gambar Produk</label>
                                <div class="custom-file">
                                    <input type="file" name="produk[0][gambar]" class="custom-file-input" onchange="previewImage(event, 0)">
                                    <label class="custom-file-label">Pilih gambar...</label>
                                </div>
                                <img id="imagePreview0" src="#" class="img-fluid mt-3 d-none" style="max-height: 200px; border-radius: 10px;">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold"><i class="fas fa-money-bill-wave"></i> Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" name="produk[0][harga]" class="form-control rounded-right" placeholder="Masukkan harga" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold"><i class="fas fa-boxes"></i> Stok</label>
                                <input type="number" name="produk[0][stok]" class="form-control rounded-pill" placeholder="Masukkan jumlah stok" required>
                            </div>

                            <button type="button" class="btn btn-danger btn-sm remove-product d-none"><i class="fas fa-trash"></i> Hapus Produk</button>
                            <hr>
                        </div>
                    </div>

                    <button type="button" id="add-product" class="btn btn-success btn-sm mb-3"><i class="fas fa-plus"></i> Tambah Produk</button>

                    <button type="submit" class="btn btn-primary btn-block rounded-pill"><i class="fas fa-save"></i> Simpan Semua</button>
                    <a href="{{ route('penjualans.index') }}" class="btn btn-secondary btn-block rounded-pill"><i class="fas fa-arrow-left"></i> Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let produkIndex = 1;

    document.getElementById('add-product').addEventListener('click', function () {
        let container = document.getElementById('produk-container');
        let newProduct = document.querySelector('.produk-item').cloneNode(true);
        
        newProduct.querySelector('h5').textContent = `Produk ${produkIndex + 1}`;
        newProduct.querySelectorAll('input').forEach(input => {
            let oldName = input.getAttribute('name');
            let newName = oldName.replace(/\d+/, produkIndex);
            input.setAttribute('name', newName);
            input.value = '';
        });

        let imagePreview = newProduct.querySelector('img');
        imagePreview.id = `imagePreview${produkIndex}`;
        imagePreview.classList.add('d-none');

        let fileInput = newProduct.querySelector('input[type="file"]');
        fileInput.setAttribute('onchange', `previewImage(event, ${produkIndex})`);

        newProduct.querySelector('.remove-product').classList.remove('d-none');
        newProduct.querySelector('.remove-product').addEventListener('click', function () {
            this.closest('.produk-item').remove();
        });

        container.appendChild(newProduct);
        produkIndex++;
    });

    function previewImage(event, index) {
        const reader = new FileReader();
        reader.onload = function () {
            const imgElement = document.getElementById(`imagePreview${index}`);
            imgElement.src = reader.result;
            imgElement.classList.remove('d-none');
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection