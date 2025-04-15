@extends('template')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header with accent card -->
       <div class="relative mb-8">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg transform -rotate-1 shadow-xl"></div>
    <div class="relative bg-white p-6 rounded-lg shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 mr-3" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                </svg>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Transaksi Penjualan</h2>
                    <p class="text-gray-500 mt-1">Menampilkan semua transaksi penjualan</p>
                </div>
            </div>
            
               <div class="mt-4 md:mt-0">
                        <a href="{{ route('penjualans.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Penjualan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        @if(session('success'))
            <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm animate-fade-in" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p>{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto">
                        <button type="button" onclick="closeAlert('success-alert')" class="text-green-700 hover:text-green-900 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div id="error-alert" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm animate-fade-in" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p>{{ session('error') }}</p>
                    </div>
                    <div class="ml-auto">
                        <button type="button" onclick="closeAlert('error-alert')" class="text-red-700 hover:text-red-900 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Filter & Search -->
        <div class="bg-white shadow-lg rounded-lg mb-6 overflow-hidden">
            <div class="p-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="relative flex-grow">
                        <input type="text" id="searchInput" class="w-full pr-10 pl-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Cari transaksi...">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                        <select id="statusFilter" class="form-select block pl-3 pr-10 py-2 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="pending">Pending</option>
                        </select>
                        <select id="methodFilter" class="form-select block pl-3 pr-10 py-2 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Semua Metode</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="e_wallet">E-Wallet</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Table -->
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 table-sales">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Pembayaran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Bayar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Bayar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kembalian</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="salesTableBody">
                        @foreach($penjualans as $penjualan)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 sale-row" 
                            data-kode="{{ $penjualan->kode_pembayaran }}" 
                            data-pelanggan="{{ $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Umum' }}"
                            data-metode="{{ $penjualan->metode_pembayaran }}"
                            data-status="{{ strtolower(strip_tags($penjualan->getStatusLabel())) }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-indigo-600">{{ $penjualan->kode_pembayaran }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ date('d-m-Y', strtotime($penjualan->tanggal_penjualan)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    {{ $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Umum' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $produkList = json_decode($penjualan->produk_id, true);
                                    $produkCount = $produkList ? count($produkList) : 0;
                                    $produkFirstTwo = $produkList ? array_slice($produkList, 0, 2) : [];
                                    $produkString = $produkFirstTwo ? implode(', ', array_map(function($produk) {
                                        return $produk['nama_produk'] . " ({$produk['jumlah']}x)";
                                    }, $produkFirstTwo)) : '-';
                                    $hasMore = $produkCount > 2;
                                @endphp
                                <div class="text-sm text-gray-700">
                                    {{ $produkString }}
                                    @if($hasMore)
                                        <span class="text-indigo-500 hover:text-indigo-700 cursor-pointer" onclick="showProductDetails(this)" data-products="{{ htmlspecialchars(json_encode($produkList)) }}"> +{{ $produkCount - 2 }} lainnya</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="font-medium">Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="font-medium">Rp {{ number_format($penjualan->jumlah_bayar ?? 0, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="font-medium">Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $methodColors = [
                                        'cash' => 'bg-green-100 text-green-800',
                                        'transfer' => 'bg-blue-100 text-blue-800',
                                        'credit_card' => 'bg-purple-100 text-purple-800',
                                        'e_wallet' => 'bg-yellow-100 text-yellow-800',
                                    ];
                                    $methodColor = $methodColors[$penjualan->metode_pembayaran] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $methodColor }}">
                                    {{ ucfirst($penjualan->metode_pembayaran) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClass = str_contains(strtolower($penjualan->getStatusLabel()), 'lunas') 
                                        ? 'bg-green-100 text-green-800' 
                                        : 'bg-yellow-100 text-yellow-800';
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ strip_tags($penjualan->getStatusLabel()) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('penjualans.show', $penjualan->penjualan_id) }}" class="text-indigo-600 hover:text-indigo-900" title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    @can('admin')
                                    <a href="{{ route('penjualans.edit', $penjualan->penjualan_id) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    <button type="button" onclick="confirmDelete('{{ route('penjualans.destroy', $penjualan->penjualan_id) }}')" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Empty state -->
            <div id="emptyState" class="hidden py-12 flex flex-col items-center justify-center">
                <div class="bg-gray-100 rounded-full p-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Tidak ada data penjualan</h3>
                <p class="text-gray-500 mt-1">Tidak ada data yang sesuai dengan filter yang dipilih</p>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span id="itemCount">{{ count($penjualans) }}</span> item
                    </div>
                    <div class="flex-1 flex justify-end">
                        <!-- Add pagination if needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Details Modal -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl mx-4 sm:mx-auto w-full max-w-md transform transition-all animate-fade-in">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Detail Produk</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeProductModal()">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="px-6 py-4">
            <ul class="divide-y divide-gray-200" id="productList"></ul>
        </div>
        <div class="bg-gray-50 px-6 py-3 rounded-b-lg">
            <button type="button" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onclick="closeProductModal()">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl mx-4 sm:mx-auto w-full max-w-md transform transition-all animate-fade-in">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h3>
        </div>
        <div class="px-6 py-4">
            <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus transaksi ini? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="bg-gray-50 px-6 py-3 flex space-x-3 rounded-b-lg">
            <button type="button" class="flex-1 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onclick="closeDeleteModal()">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="flex-1">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete">
                <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Close alert notifications
function closeAlert(id) {
    const alert = document.getElementById(id);
    alert.classList.add('animate-fade-out');
    setTimeout(() => {
        alert.style.display = 'none';
    }, 300);
}

// Search and filter functionality
function filterTable() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
    const methodFilter = document.getElementById('methodFilter').value.toLowerCase();
    const rows = document.querySelectorAll('.sale-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const kode = row.getAttribute('data-kode').toLowerCase();
        const pelanggan = row.getAttribute('data-pelanggan').toLowerCase();
        const metode = row.getAttribute('data-metode').toLowerCase();
        const status = row.getAttribute('data-status').toLowerCase();
        
        const matchesSearch = kode.includes(searchValue) || pelanggan.includes(searchValue);
        const matchesStatus = statusFilter === '' || status.includes(statusFilter);
        const matchesMethod = methodFilter === '' || metode === methodFilter;
        
        if (matchesSearch && matchesStatus && matchesMethod) {
            row.classList.remove('hidden');
            visibleCount++;
        } else {
            row.classList.add('hidden');
        }
    });
    
    document.getElementById('itemCount').textContent = visibleCount;
    
    // Show/hide empty state
    if (visibleCount === 0) {
        document.getElementById('emptyState').classList.remove('hidden');
    } else {
        document.getElementById('emptyState').classList.add('hidden');
    }
}

// Event listeners for search and filter
document.getElementById('searchInput').addEventListener('keyup', filterTable);
document.getElementById('statusFilter').addEventListener('change', filterTable);
document.getElementById('methodFilter').addEventListener('change', filterTable);

// Product details modal
function showProductDetails(element) {
    const products = JSON.parse(element.getAttribute('data-products'));
    const productList = document.getElementById('productList');
    productList.innerHTML = '';
    
    products.forEach(product => {
        const item = document.createElement('li');
        item.className = 'py-3';
        item.innerHTML = `
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900">${product.nama_produk}</p>
                    <p class="text-sm text-gray-500">Jumlah: ${product.jumlah}x</p>
                </div>
                <p class="text-sm font-medium text-gray-900">Rp ${new Intl.NumberFormat('id-ID').format(product.harga * product.jumlah)}</p>
            </div>
        `;
        productList.appendChild(item);
    });
    
    document.getElementById('productModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeProductModal() {
    document.getElementById('productModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Delete confirmation modal
function confirmDelete(deleteUrl) {
    document.getElementById('deleteForm').action = deleteUrl;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Close modals when clicking outside
window.addEventListener('click', function(event) {
    const productModal = document.getElementById('productModal');
    const deleteModal = document.getElementById('deleteModal');
    
    if (event.target === productModal) {
        closeProductModal();
    }
    
    if (event.target === deleteModal) {
        closeDeleteModal();
    }
});

// Escape key closes modals
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeProductModal();
        closeDeleteModal();
    }
});

// Add row hover effect
document.querySelectorAll('.sale-row').forEach(row => {
    row.addEventListener('mouseover', function() {
        this.classList.add('bg-blue-50');
    });
    
    row.addEventListener('mouseout', function() {
        this.classList.remove('bg-blue-50');
    });
});

// Initialize the table on page load
document.addEventListener('DOMContentLoaded', function() {
    // Check for any filters in URL parameters and apply them
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    const statusParam = urlParams.get('status');
    const methodParam = urlParams.get('method');
    
    if (searchParam) {
        document.getElementById('searchInput').value = searchParam;
    }
    
    if (statusParam) {
        document.getElementById('statusFilter').value = statusParam;
    }
    
    if (methodParam) {
        document.getElementById('methodFilter').value = methodParam;
    }
    
    // Apply filters if any parameters were set
    if (searchParam || statusParam || methodParam) {
        filterTable();
    }
    
    // Auto-hide success alerts after 5 seconds
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            closeAlert('success-alert');
        }, 5000);
    }
});
</script>
@endsection