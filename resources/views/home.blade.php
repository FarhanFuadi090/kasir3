@extends('template')
@section('content')


<div class="container py-5">
    <!-- Baris 1: 3 kartu -->
    <div class="row g-4 justify-content-center">
        <!-- Total Pelanggan -->
        <div class="col-md-4">
            <div class="stat-card customer-card shadow-lg">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                
                <div class="stat-content">
                    <h3 class="stat-value" id="totalPelanggan">{{ $totalPelanggan ?? 0 }}</h3>
                    <p class="stat-label">Total Pelanggan</p>
                </div>
            </div>
        </div>

        <!-- Total Produk -->
        <div class="col-md-4">
            <div class="stat-card product-card shadow-lg">
                <div class="card-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value" id="totalProduk">{{ $totalProduk ?? 0 }}</h3>
                    <p class="stat-label">Total Produk</p>
                </div>
            </div>
        </div>

        <!-- Total Penjualan -->
        <div class="col-md-4">
            <div class="stat-card sales-card shadow-lg">
                <div class="card-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value" id="totalPenjualan">{{ $penjualanCount ?? 0 }}</h3>
                    <p class="stat-label">Total Penjualan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Baris 2: 2 kartu -->
    <div class="row g-4 mt-4 justify-content-center">
        <!-- Total Pendapatan -->
        <div class="col-md-4">
            <div class="stat-card revenue-card shadow-lg">
                <div class="card-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-content">
              <h3 class="stat-value" id="totalPendapatan">  Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h3>
              <p class="stat-label">Total Pendapatan</p>
                </div>
            </div>
        </div>

        <!-- Produk Stok Rendah -->
        <div class="col-md-4">
            <div class="stat-card lowstock-card shadow-lg">
                <div class="card-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value" id="stokRendah">{{ $stokRendah ?? 0 }}</h3>
                    <p class="stat-label">Produk Stok Rendah</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- jQuery AJAX untuk Update Total -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function updateTotalPelanggan() {
            $.ajax({
                url: "{{ route('getTotalPelanggan') }}",
                type: "GET",
                success: function (response) {
                    animateCounter('totalPelanggan', response.totalPelanggan);
                }
            });
        }

        function updateTotalProduk() {
            $.ajax({
                url: "{{ route('getTotalProduk') }}",
                type: "GET",
                success: function (response) {
                    animateCounter('totalProduk', response.totalProduk);
                }
            });
        }

        function updateTotalPenjualan() {
            $.ajax({
                url: "{{ route('getTotalPenjualan') }}",
                type: "GET",
                success: function (response) {
                    animateCounter('totalPenjualan', response.totalPenjualan);
                }
            });
        }
        
        function updateStokRendah() {
            $.ajax({
                url: "{{ route('getStokRendah') }}",
                type: "GET",
                success: function (response) {
                    animateCounter('stokRendah', response.stokRendah);
                }
            });
        }

        // Counter animation function
        function animateCounter(elementId, newValue) {
            const element = document.getElementById(elementId);
            const currentValue = parseInt(element.textContent);
            
            if (currentValue !== newValue) {
                let startValue = currentValue;
                const duration = 1000; // 1 second
                const startTime = performance.now();
                
                function updateCounter(currentTime) {
                    const elapsedTime = currentTime - startTime;
                    
                    if (elapsedTime < duration) {
                        const progress = elapsedTime / duration;
                        const value = Math.floor(startValue + (newValue - startValue) * progress);
                        element.textContent = value;
                        requestAnimationFrame(updateCounter);
                    } else {
                        element.textContent = newValue;
                    }
                }
                
                requestAnimationFrame(updateCounter);
            }
        }

        // Jalankan fungsi saat halaman pertama kali dimuat
        updateTotalPelanggan();
        updateTotalProduk();
        updateTotalPenjualan();
        updateStokRendah();

        // Set interval agar data terus diperbarui tiap 5 detik
        setInterval(updateTotalPelanggan, 5000);
        setInterval(updateTotalProduk, 5000);
        setInterval(updateTotalPenjualan, 5000);
        setInterval(updateStokRendah, 5000);
    });
</script>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4e54c8, #8f94fb);
        --warning-gradient: linear-gradient(135deg, #ff9966, #ff5e62);
        --success-gradient: linear-gradient(135deg, #0ba360, #3cba92);
        --lowstock-gradient: linear-gradient(135deg, #f85032, #e73827);
        .revenue-card {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        --border-radius: 16px;
    }

    .container {
        max-width: 1200px;
    }

    /* Modern Card Design */
    .stat-card {
        display: flex;
        border-radius: var(--border-radius);
        overflow: hidden;
        padding: 1.5rem;
        height: 200px;
        position: relative;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .customer-card {
        background: var(--primary-gradient);
    }

    .product-card {
        background: var(--warning-gradient);
    }

    .sales-card {
        background: var(--success-gradient);
    }

    .lowstock-card {
        background: var(--lowstock-gradient);
    }

    .card-icon {
        background: rgba(255, 255, 255, 0.2);
        height: 70px;
        width: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
    }

    .card-icon i {
        font-size: 2rem;
        color: white;
        filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.5));
    }

    .stat-content {
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .stat-label {
        font-size: 1.1rem;
        margin-bottom: 0;
        opacity: 0.9;
        font-weight: 500;
    }

    /* Creating a subtle pattern overlay */
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }

    /* Add a subtle pulse animation to the card on hover */
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4); }
        70% { box-shadow: 0 0 0 15px rgba(255, 255, 255, 0); }
        100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
    }

    .stat-card:hover .card-icon {
        animation: pulse 1.5s infinite;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .stat-card {
            height: 160px;
            padding: 1rem;
        }
        
        .card-icon {
            height: 55px;
            width: 55px;
        }
        
        .stat-value {
            font-size: 2rem;
        }
        
        .stat-label {
            font-size: 1rem;
        }
    }
</style>

@endsection
