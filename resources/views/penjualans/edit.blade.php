@extends('template')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 py-12 px-4 sm:px-6">
    <div class="max-w-5xl mx-auto">
        <!-- Header with accent card -->
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg transform -rotate-1 shadow-xl"></div>
            <div class="relative bg-white p-6 rounded-lg shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Edit Penjualan</h2>
                        <p class="text-gray-500 mt-1">Ubah data transaksi penjualan</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('penjualans.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('penjualans.update', $penjualan->penjualan_id) }}" method="POST" class="space-y-6">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            
            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <!-- Customer & Date Section -->
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="pelanggan">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    Pelanggan
                                </span>
                            </label>
                            <select name="pelanggan_id" id="pelanggan" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                                <option value="">Pilih Pelanggan (Opsional)</option>
                                @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->pelanggan_id }}" {{ $penjualan->pelanggan_id == $pelanggan->pelanggan_id ? 'selected' : '' }}>
                                        {{ $pelanggan->nama_pelanggan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="tanggal">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    Tanggal Penjualan
                                </span>
                            </label>
                            <input type="date" name="tanggal_penjualan" id="tanggal" value="{{ $penjualan->tanggal_penjualan }}" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" required>
                        </div>
                    </div>
                </div>
                
                <!-- Products Section -->
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Produk</h3>
                        <button type="button" id="tambah-produk-btn" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded-lg transition duration-300 flex items-center text-sm font-medium shadow-sm" onclick="tambahProduk()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Tambah Produk
                        </button>
                    </div>
                    
                    <div id="produk-container" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="hidden md:grid md:grid-cols-4 gap-4 p-4 bg-gray-100 text-sm font-medium text-gray-600">
                            <div>Produk</div>
                            <div>Jumlah</div>
                            <div>Subtotal</div>
                            <div></div>
                        </div>
                        
                        <div id="produk-list" class="divide-y divide-gray-200">
                            <!-- Produk Item - Always create at least one empty item -->
                            <div class="produk-item p-4 hover:bg-blue-50 transition duration-150">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 md:hidden mb-1">Produk</label>
                                        <select name="produk_id[]" class="produk-select w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" required onchange="updateSubtotal(this)">
                                            <option value="">Pilih Produk</option>
                                            @foreach($produks as $produk)
                                                <option value="{{ $produk->produk_id }}" data-harga="{{ $produk->harga }}">
                                                    {{ $produk->nama_produk }} - Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 md:hidden mb-1">Jumlah</label>
                                        <input type="number" name="jumlah[]" class="jumlah-input w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" placeholder="Jumlah" min="1" required oninput="updateSubtotal(this)">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 md:hidden mb-1">Subtotal</label>
                                        <input type="text" name="subtotal[]" class="subtotal-input w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg" placeholder="Subtotal" readonly>
                                    </div>
                                    <div class="flex items-center justify-end">
                                        <button type="button" class="hapus-btn bg-red-100 hover:bg-red-200 text-red-600 hover:text-red-700 p-2 rounded-lg transition duration-300" onclick="hapusProduk(this)" title="Hapus Produk">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Section -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="metode_pembayaran">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                        <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                                    </svg>
                                    Metode Pembayaran
                                </span>
                            </label>
                            <select name="metode_pembayaran" id="metode_pembayaran" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                                <option value="cash" {{ $penjualan->metode_pembayaran == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="transfer" {{ $penjualan->metode_pembayaran == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                <option value="credit_card" {{ $penjualan->metode_pembayaran == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                <option value="e_wallet" {{ $penjualan->metode_pembayaran == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="jumlah_bayar">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                    </svg>
                                    Jumlah Bayar
                                </span>
                            </label>
                            <input type="number" id="jumlah_bayar" name="jumlah_bayar" value="{{ $penjualan->jumlah_bayar }}" class="w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" required oninput="hitungKembalian()">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Summary Section -->
            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Transaksi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm text-gray-600">Total Produk:</span>
                                    <span id="total_produk" class="font-medium">0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Total Pembayaran:</span>
                                    <span id="total_display" class="font-medium">Rp 0</span>
                                </div>
                                <input type="hidden" id="total_bayar" name="total_bayar" value="{{ $penjualan->total_bayar ?? 0 }}">
                            </div>
                        </div>
                        <div>
                        <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-indigo-600">Jumlah Bayar:</span>
                                <span id="jumlah_display" class="font-medium">Rp 0</span>
                            </div>
                        </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-indigo-600">Kembalian:</span>
                                    <span id="kembalian" class="font-medium">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('penjualans.index') }}" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="inline-flex justify-center items-center px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function tambahProduk() {
    let produkList = document.getElementById("produk-list");
    let produkItem = document.createElement("div");
    produkItem.className = "produk-item p-4 hover:bg-blue-50 transition duration-150";
    
    produkItem.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 md:hidden mb-1">Produk</label>
                <select name="produk_id[]" class="produk-select w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" required onchange="updateSubtotal(this)">
                    <option value="">Pilih Produk</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->produk_id }}" data-harga="{{ $produk->harga }}">
                            {{ $produk->nama_produk }} - Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 md:hidden mb-1">Jumlah</label>
                <input type="number" name="jumlah[]" class="jumlah-input w-full px-3 py-2 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" placeholder="Jumlah" min="1" required oninput="updateSubtotal(this)">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 md:hidden mb-1">Subtotal</label>
                <input type="text" name="subtotal[]" class="subtotal-input w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg" placeholder="Subtotal" readonly>
            </div>
            <div class="flex items-center justify-end">
                <button type="button" class="hapus-btn bg-red-100 hover:bg-red-200 text-red-600 hover:text-red-700 p-2 rounded-lg transition duration-300" onclick="hapusProduk(this)" title="Hapus Produk">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                       <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    `;
    
    produkList.appendChild(produkItem);
    updateTotalProduk();
}

function hapusProduk(button) {
    let produkItems = document.querySelectorAll('.produk-item');
    if (produkItems.length > 1) {
        let produkItem = button.closest('.produk-item');
        produkItem.remove();
        updateTotalProduk();
        updateTotal();
    } else {
        alert('Minimal harus ada 1 produk');
    }
}

function updateSubtotal(element) {
    let produkItem = element.closest('.produk-item');
    let produkSelect = produkItem.querySelector('.produk-select');
    let jumlahInput = produkItem.querySelector('.jumlah-input');
    let subtotalInput = produkItem.querySelector('.subtotal-input');
    
    if (produkSelect.value && jumlahInput.value) {
        let selectedOption = produkSelect.options[produkSelect.selectedIndex];
        let harga = parseFloat(selectedOption.getAttribute('data-harga'));
        let jumlah = parseFloat(jumlahInput.value);
        let subtotal = harga * jumlah;
        
        subtotalInput.value = formatRupiah(subtotal);
        updateTotal();
    } else {
        subtotalInput.value = '';
    }
}

function updateTotal() {
    let subtotalInputs = document.querySelectorAll('.subtotal-input');
    let total = 0;
    
    subtotalInputs.forEach(function(input) {
        if (input.value) {
            // Extract numbers from the formatted string
            let value = input.value.replace(/[^\d]/g, '');
            if (value) {
                total += parseInt(value);
            }
        }
    });
    
    document.getElementById('total_display').textContent = formatRupiah(total);
    document.getElementById('total_bayar').value = total;
    hitungKembalian();
}

function hitungKembalian() {
    let totalBayar = parseFloat(document.getElementById('total_bayar').value) || 0;
    let jumlahBayar = parseFloat(document.getElementById('jumlah_bayar').value) || 0;
    let kembalian = jumlahBayar - totalBayar;
    
    // Assuming you have an input field with id "jumlah" or similar
document.getElementById('jumlah').addEventListener('input', function() {
    let value = this.value || 0;
    document.getElementById('jumlah_display').textContent = 'Rp ' + 
        Number(value).toLocaleString('id-ID');
});

// If you're loading an existing value, update the display on page load
document.addEventListener('DOMContentLoaded', function() {
    let initialValue = document.getElementById('jumlah').value || 0;
    document.getElementById('jumlah_display').textContent = 'Rp ' + 
        Number(initialValue).toLocaleString('id-ID');
});

function formatRupiah(angka) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
}

function updateTotalProduk() {
    let produkItems = document.querySelectorAll('.produk-item');
    document.getElementById('total_produk').textContent = produkItems.length;
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateTotalProduk();
    updateTotal();
});
</script>
@endsection