@extends('template')

@section('content')

<!-- Enhanced Background with Refined UI -->
<div class="min-h-screen bg-gradient-to-br from-blue-100 to-indigo-100 py-12 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">

        <!-- REFINED NON-PRINTABLE CONTROLS -->
        <div class="non-print mb-5">
            <div class="flex flex-col md:flex-row gap-4 justify-between items-center bg-white p-5 rounded-xl shadow-md">
                <!-- Search with enhanced styling -->
                <div class="relative w-full md:w-1/2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput" 
                           class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                           placeholder="Cari laporan berdasarkan kode, pelanggan, atau produk...">
                </div>
                
                <!-- Filtering options with better styling -->
                <div class="dropdown w-full md:w-auto">
                    <button class="w-full md:w-auto flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-lg transition duration-200" 
                            type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Pilih Periode</span>
                        <i class="fas fa-chevron-down text-sm"></i>
                    </button>
                    <ul class="dropdown-menu w-full md:w-48 mt-1 py-2 bg-white rounded-lg shadow-lg border border-gray-100" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-indigo-50 transition duration-200" href="{{ route('laporans.index', ['periode' => 'hari']) }}">Hari Ini</a></li>
                        <li><a class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-indigo-50 transition duration-200" href="{{ route('laporans.index', ['periode' => 'minggu']) }}">Minggu Ini</a></li>
                        <li><a class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-indigo-50 transition duration-200" href="{{ route('laporans.index', ['periode' => 'bulan']) }}">Bulan Ini</a></li>
                        <li><a class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-indigo-50 transition duration-200" href="{{ route('laporans.index', ['periode' => 'tahun']) }}">Tahun Ini</a></li>
                        <li><hr class="my-2 border-gray-200"></li>
                        <li><a class="dropdown-item block px-4 py-2 text-gray-700 hover:bg-indigo-50 transition duration-200" href="{{ route('laporans.index', ['periode' => 'semua']) }}">Semua Data</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- PRINTABLE AREA - Enhanced styling -->
        <div class="print-area">
            
            <!-- Enhanced Header with Better Information Display -->
            <div class="mb-6">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between p-6">
                        <div class="flex items-center mb-4 md:mb-0">
                            <div class="bg-indigo-100 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M4 3a1 1 0 011 1v14h14a1 1 0 110 2H4a1 1 0 01-1-1V4a1 1 0 011-1zm13 6a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm-4-3a1 1 0 011 1v8a1 1 0 11-2 0V7a1 1 0 011-1zm-4 5a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-gray-800">Laporan Penjualan</h2>
                                <p class="text-gray-500 mt-1">{{ $periodeText ?? 'Semua Periode' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Total Penjualan</div>
                            <div class="text-2xl font-bold text-indigo-600">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
                            <div class="text-sm text-gray-500 mt-1">{{ count($penjualans) }} Transaksi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Table Design -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="laporanTable">
                        <thead>
                            <tr class="bg-indigo-600 text-white">
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Kode Pembayaran</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Pelanggan</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Produk</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Metode Pembayaran</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($penjualans as $penjualan)
                                @if($penjualan->kode_pembayaran != '-')
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-center text-sm font-medium text-gray-900">{{ $penjualan->kode_pembayaran }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">{{ date('d-m-Y', strtotime($penjualan->tanggal_penjualan)) }}</td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $penjualan->pelanggan->nama_pelanggan ?? 'Umum' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-500">
                                            @php
                                                $produkList = json_decode($penjualan->produk_id, true);
                                                $produkString = $produkList ? implode(', ', array_map(function($produk) {
                                                    return $produk['nama_produk'] . " ({$produk['jumlah']}x)";
                                                }, $produkList)) : '-';
                                            @endphp
                                            <div class="max-w-xs truncate">{{ $produkString }}</div>
                                        </td>
                                        <td class="px-4 py-3 text-center text-sm text-gray-500">
                                            @if($penjualan->metode_pembayaran == 'cash')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-money-bill-wave mr-1"></i> Cash
                                                </span>
                                            @elseif($penjualan->metode_pembayaran == 'transfer')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <i class="fas fa-university mr-1"></i> Transfer
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    {{ ucfirst($penjualan->metode_pembayaran) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center text-sm">
                                            @if($penjualan->status == 'paid')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-check-circle mr-1"></i> Lunas
                                                </span>
                                            @elseif($penjualan->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-clock mr-1"></i> Menunggu
                                                </span>
                                            @elseif($penjualan->status == 'failed')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-times-circle mr-1"></i> Gagal
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    Tidak Diketahui
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-center text-sm font-medium text-gray-900">Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="8" class="px-4 py-8 text-center text-sm text-gray-500">Tidak ada data penjualan untuk periode ini.</td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-8 text-center text-sm text-gray-500">Tidak ada data penjualan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <!-- Improved Footer with Summary -->
                        <tfoot>
                            <tr class="bg-gray-50">
                                <td colspan="6" class="px-4 py-4 text-right text-sm font-medium text-gray-900">Total Penjualan</td>
                                <td colspan="2" class="px-4 py-4 text-center text-base font-bold text-indigo-600">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            <!-- Added report footer with timestamp -->
            <div class="mt-6 text-right text-sm text-gray-500">
                <p>Laporan dibuat: {{ date('d/m/Y H:i') }}</p>
            </div>
        </div>
        <!-- END PRINTABLE AREA -->

        <!-- Enhanced Print Button -->
        <div class="non-print mt-6 flex justify-center">
            <button class="flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-8 rounded-lg transition duration-200 shadow-md hover:shadow-lg" onclick="printStrukSemua()">
                <i class="fas fa-print"></i>
                <span>Cetak Laporan</span>
            </button>
        </div>

    </div>
</div>

<!-- Enhanced Scripts -->
<script>
    // Search functionality
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        let tableRows = document.querySelectorAll("#laporanTable tbody tr");
        let noResults = true;

        tableRows.forEach(row => {
            // Skip the "no data" row
            if (row.cells.length < 3) return;
            
            let kodePembayaran = row.cells[1].innerText.toLowerCase();
            let tanggal = row.cells[2].innerText.toLowerCase();
            let pelanggan = row.cells[3].innerText.toLowerCase();
            let produk = row.cells[4].innerText.toLowerCase();
            let metode = row.cells[5].innerText.toLowerCase();

            if (kodePembayaran.includes(searchValue) || 
                tanggal.includes(searchValue) ||
                pelanggan.includes(searchValue) || 
                produk.includes(searchValue) ||
                metode.includes(searchValue)) {
                row.style.display = "";
                noResults = false;
            } else {
                row.style.display = "none";
            }
        });

        // Show a "no results" message if no rows match
        let noResultsRow = document.getElementById("noResultsRow");
        if (noResults && searchValue !== "") {
            if (!noResultsRow) {
                let tbody = document.querySelector("#laporanTable tbody");
                noResultsRow = document.createElement("tr");
                noResultsRow.id = "noResultsRow";
                noResultsRow.innerHTML = `<td colspan="8" class="px-4 py-8 text-center text-sm text-gray-500">Tidak ada data yang sesuai dengan pencarian "${searchValue}"</td>`;
                tbody.appendChild(noResultsRow);
            } else {
                noResultsRow.style.display = "";
                noResultsRow.querySelector("td").innerHTML = `Tidak ada data yang sesuai dengan pencarian "${searchValue}"`;
            }
        } else if (noResultsRow) {
            noResultsRow.style.display = "none";
        }
    });

    // Print functionality with confirmation
    function printStrukSemua() {
        if (confirm("Apakah Anda yakin ingin mencetak laporan ini?")) {
            window.print();
        }
    }
    
    // Add active class to current period filter
    document.addEventListener("DOMContentLoaded", function() {
        const currentUrl = window.location.href;
        const dropdownItems = document.querySelectorAll(".dropdown-item");
        
        dropdownItems.forEach(item => {
            if (currentUrl.includes(item.getAttribute("href"))) {
                item.classList.add("bg-indigo-50", "font-medium");
                document.getElementById("dropdownMenuButton").innerHTML = 
                    `<i class="fas fa-calendar-alt"></i> <span>${item.innerText}</span> <i class="fas fa-chevron-down text-sm"></i>`;
            }
        });
    });
</script>

<!-- Enhanced Print Styles -->
<style>
@media print {
    body * {
        visibility: hidden !important;
    }

    .print-area, .print-area * {
        visibility: visible !important;
    }

    .print-area {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        padding: 20px;
    }

    .non-print, .non-print * {
        display: none !important;
    }

    @page {
        size: landscape;
        margin: 15mm;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th {
        background-color: #4f46e5 !important;
        color: white !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    tr:nth-child(even) {
        background-color: #f9fafb !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    
    th, td {
        padding: 8px;
        border: 1px solid #e5e7eb;
        font-size: 11px;
    }
    
    tfoot {
        font-weight: bold;
        background-color: #f3f4f6 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}
</style>

@endsection