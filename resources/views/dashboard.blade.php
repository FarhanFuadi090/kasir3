@extends('template')
@section('content')
<div class="container">
    <div class="row">
        <!-- Total Pelanggan -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total Pelanggan</h5>
                    <p class="card-text" id="totalPelanggan">{{ $totalPelanggan ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Detail Penjualan -->
        <!-- Total Produk -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-box"></i> Total Produk</h5>
                    <p class="card-text" id="totalProduk">{{ $totalProduk ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery AJAX untuk Update Total Pelanggan & Detail Penjualan -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function updateTotalPelanggan() {
            $.ajax({
                url: "{{ route('getTotalPelanggan') }}",
                type: "GET",
                success: function (response) {
                    $('#totalPelanggan').text(response.totalPelanggan);
                }
            });
        }

       

        // Jalankan fungsi saat halaman pertama kali dimuat
        updateTotalPelanggan();
        
        // Set interval agar data terus diperbarui tiap 5 detik
        setInterval(updateTotalPelanggan, 5000);
        setInterval(updateTotalDetailPenjualan, 5000);
    });
</script>
@endsection
