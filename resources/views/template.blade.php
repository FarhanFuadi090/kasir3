<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaiadmin - Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/heroicons@1.0.1/outline/solid.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #f8b400 !important;
        }
        .profile-img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }
        .search-results {
            position: absolute;
            background: white;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            max-height: 200px;
            overflow-y: auto;
        }
        .search-results a {
            display: block;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            color: #333;
            text-decoration: none;
        }
        .search-results a:hover {
            background: #f8f9fa;
        }

        .search-container {
        display: flex;
        align-items: center; /* Menjaga ikon tetap sejajar */
    }
    .search-input {
        flex: 1; /* Agar input memenuhi lebar yang tersedia */
        border-radius: 4px 0 0 4px; /* Membuat sisi kiri membulat */
    }
    .search-button {
        border-radius: 0 4px 4px 0; /* Membuat sisi kanan membulat */
    }
    .search-container {
        display: flex;
        align-items: center;
        max-width: 300px; /* Atur lebar maksimal */
    }
    .search-input {
        flex: 1;
        height: 38px; /* Samakan tinggi dengan button */
        border-radius: 4px 0 0 4px; /* Agar sudutnya menyatu */
    }
    .search-button {
        height: 38px; /* Samakan tinggi dengan input */
        border-radius: 0 4px 4px 0; /* Agar sudutnya menyatu */
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-store"></i> Kasir</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('home') ? 'active text-warning' : '' }}" href="{{ route('home') }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
    </li>

    @can('admin')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('pelanggans*') ? 'active text-warning' : '' }}" href="{{ route('pelanggans.index') }}">
            <i class="fas fa-users"></i> Pelanggan
        </a>
    </li>
    @endcan

    <li class="nav-item">
        <a class="nav-link {{ Request::is('penjualans*') ? 'active text-warning' : '' }}" href="{{ route('penjualans.index') }}">
            <i class="fas fa-shopping-cart"></i> Penjualan
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Request::is('produks*') ? 'active text-warning' : '' }}" href="{{ route('produks.index') }}">
            <i class="fas fa-box"></i> Produk
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Request::is('laporans*') ? 'active text-warning' : '' }}" href="{{ route('laporans.index') }}">
            <i class="fas fa-chart-line"></i> Laporan
        </a>
    </li>
</ul>

    <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger ms-2"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/core/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
