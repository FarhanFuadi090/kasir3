@extends('template')

@section('content')

<!-- Tambahkan Bootstrap 5 dan FontAwesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --success-color: #4cc9f0;
        --danger-color: #f72585;
    }

    body {
        background-color: #f8f9fa;
    }

    .page-header {
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        padding: 24px;
        margin-bottom: 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #333;
        margin: 0;
    }
    
    .page-title i {
        color: var(--primary-color);
        margin-right: 8px;
    }

    .btn-add {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(67, 97, 238, 0.2);
    }

    .search-container {
        position: relative;
        margin-bottom: 24px;
    }

    .search-input {
        border-radius: 12px;
        padding: 14px 20px 14px 45px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(72, 149, 239, 0.15);
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
    }
/* Update the product grid to have smaller cards */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Reduced from 250px */
    gap: 16px; /* Reduced from 24px */
}

.product-card {
    background: white;
    border-radius: 12px; /* Reduced from 16px */
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); /* Reduced shadow */
    transition: all 0.3s ease;
    height: 100%;
}

.product-image {
    height: 150px; /* Reduced from 180px */
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.product-info {
    padding: 12px; /* Reduced from 18px */
}

.product-name {
    font-weight: 600;
    margin-bottom: 6px; /* Reduced from 8px */
    color: #333;
    font-size: 0.9rem; /* Added smaller font size */
}

.product-price {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1rem; /* Reduced from 1.1rem */
    margin-bottom: 6px; /* Reduced from 8px */
}

.product-stock {
    color: #6c757d;
    font-size: 0.8rem; /* Reduced from 0.85rem */
    margin-bottom: 12px; /* Reduced from 16px */
}

.product-actions {
    display: flex;
    gap: 6px; /* Reduced from 8px */
}

.btn-edit, .btn-delete {
    border: none;
    border-radius: 8px; /* Reduced from 10px */
    padding: 6px 10px; /* Reduced from 8px 12px */
    transition: all 0.2s ease;
    font-size: 0.85rem; /* Added smaller font size */
}

    .btn-edit {
        background-color: #ffd166;
        color: #333;
    }

    .btn-delete {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-edit:hover, .btn-delete:hover {
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-state i {
        font-size: 3rem;
        color: #dee2e6;
        margin-bottom: 16px;
    }

    .empty-state p {
        color: #6c757d;
        font-size: 1.1rem;
    }
    
    .scrollable {
        max-height: 700px;
        overflow-y: auto;
        padding: 12px;
        border-radius: 16px;
    }
    
    /* Custom scrollbar */
    .scrollable::-webkit-scrollbar {
        width: 8px;
    }
    
    .scrollable::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .scrollable::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    .scrollable::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>

<div class="container py-4">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title"><i class="fas fa-shopping-bag"></i> Daftar Produk</h1>
        @can('admin')
            <a href="{{ route('produks.create') }}" class="btn btn-add">
                <i class="fas fa-plus-circle me-2"></i> Tambah Produk
            </a>
        @endcan
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" id="searchInput" class="form-control search-input" placeholder="Cari produk...">
    </div>

    <!-- Products Container -->
    <div class="scrollable">
        <div class="product-grid" id="produkContainer">
            @forelse ($produks as $produk)
                <div class="product-item">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ $produk->gambar ? asset('storage/'.$produk->gambar) : 'https://via.placeholder.com/150' }}" 
                                 alt="Gambar {{ $produk->nama_produk }}">
                        </div>
                        <div class="product-info">
                            <h5 class="product-name text-truncate">{{ $produk->nama_produk }}</h5>
                            <div class="product-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                            <div class="product-stock">
                                <i class="fas fa-cubes me-1"></i> Stok: {{ $produk->stok }}
                            </div>
                            @can('admin')
                            <div class="product-actions">
                                <a href="{{ route('produks.edit', $produk->produk_id) }}" class="btn btn-edit w-100">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('produks.destroy', $produk->produk_id) }}" method="POST" class="w-100" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?')">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn btn-delete w-100">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <p>Tidak ada produk tersedia</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Script Filter Pencarian -->
<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        let produkItems = document.querySelectorAll(".product-item");

        produkItems.forEach(item => {
            let namaProduk = item.querySelector(".product-name").innerText.toLowerCase();

            if (namaProduk.includes(searchValue)) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    });
</script>

@endsection