<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $primaryKey = 'produk_id';
    protected $table = 'produks';
    protected $fillable = [
        "nama_produk",
        "harga",
        "stok",
        "gambar",
        
     
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'produk_id','produk_id');
    }

    // Metode untuk mengurangi stok
    public function kurangiStok($jumlah)
    {
        if ($this->stok < $jumlah) {
            return false; // Stok tidak mencukupi
        }

        $this->stok -= $jumlah;
        return $this->save();
    }

    public function tambahStok($jumlah)
    {
        $this->stok += $jumlah;
        return $this->save();
    }
}
