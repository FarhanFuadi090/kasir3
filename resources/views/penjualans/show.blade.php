

<div class="container">
    <div class="receipt-container">
        <div class="store-name">IndoMart</div>
        <div class="receipt-header">Jl. Contoh No. 123, Jakarta<br>Telp: 021-12345678</div>
        <div class="divider"></div>

        <p><strong>Kode Pembayaran:</strong> {{ $penjualan->kode_pembayaran }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d-m-Y H:i') }}</p>
        <p><strong>Pelanggan:</strong> {{ $penjualan->pelanggan->nama_pelanggan ?? 'Umum' }}</p>
        <p><strong>Metode Pembayaran:</strong> 
    <span class="payment-method 
        {{ $penjualan->metode_pembayaran == 'cash' ? 'cash' : ($penjualan->metode_pembayaran == 'transfer' ? 'transfer' : 'other') }}">
        {{ ucfirst($penjualan->metode_pembayaran) }}
    </span>
</p>
<div style="display: flex; align-items: center;">
    <strong style="margin-right: 5px;">Status Pembayaran:</strong> {!! $penjualan->getStatusLabel() !!}
</div>


        <div class="divider"></div>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th style="text-align:center;">Qty</th>
                    <th style="text-align:right;">Harga satuan</th>
                </tr>
            </thead>
            <tbody>
              @php

    $produkList = json_decode($penjualan->produk_id, true);
@endphp
@if($produkList)
    @foreach($produkList as $produk)
    <tr>
        <td>{{ $produk['nama_produk'] }}</td>
        <td style="text-align:center;">{{ $produk['jumlah'] }}</td>
        <td style="text-align:right;">Rp {{ number_format($produk['harga'], 0, ',', '.') }}</td>
    </tr>
    @endforeach
@endif


            </tbody>
        </table>

        <div class="divider"></div>
        <div class="total-section">
            <p><strong>Total Bayar:</strong> Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</p>
            <p><strong>Jumlah Bayar:</strong> Rp {{ number_format($penjualan->jumlah_bayar, 0, ',', '.') }}</p>
            <p class="highlight"><strong>Kembalian:</strong> Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}</p>
        </div>

        <div class="divider"></div>
        <div class="receipt-footer">*** Terima kasih telah berbelanja di IndoMart ***</div>
        <div class="button-container">
            <button class="btn print-btn" onclick="window.print()">Cetak Struk</button>
            <a href="{{ route('penjualans.index') }}" class="btn back-btn">Kembali</a>
        </div>
    </div>
</div>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background: #f4f4f4;
        margin: 0;
        padding: 20px;
    }
    .receipt-container {
        width: 320px;
        margin: auto;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }
    .store-name {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 5px;
        text-transform: uppercase;
        color: #007bff;
    }
    .receipt-header, .receipt-footer {
        text-align: center;
        font-size: 12px;
        margin-bottom: 10px;
        color: #555;
    }
    .divider {
        border-top: 1px dashed #aaa;
        margin: 10px 0;
    }
    table {
        width: 100%;
        font-size: 14px;
        border-collapse: collapse;
    }
    table th, table td {
        text-align: left;
        padding: 6px 0;
    }
    .total-section {
        font-size: 14px;
        font-weight: bold;
        text-align: right;
        margin-top: 10px;
    }
    .highlight {
        font-size: 14px;
        font-weight: bold;
        text-align: right;
        color: #d9534f;
    }
    .payment-method {
        font-size: 14px;
        font-weight: bold;
        text-transform: capitalize;
        color: #fff;
        padding: 4px 8px;
        display: inline-block;
        border-radius: 4px;
    }
    .cash { background-color: #28a745; } /* Warna Hijau */
    .transfer { background-color: #17a2b8; } /* Warna Biru */
    .other { background-color: #6c757d; } /* Warna Abu-abu */
    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }
    .btn {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
        color: white;
    }
    .print-btn {
        background-color: #007bff;
    }
    .print-btn:hover {
        background-color: #0056b3;
    }
    .back-btn {
        background-color: #6c757d;
        margin-left: 10px;
    }
    .back-btn:hover {
        background-color: #5a6268;
    }
    @media print {
        .button-container {
            display: none;
        }
    }
</style>

