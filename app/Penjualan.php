<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $primaryKey ='penjualan_id';
    protected $table ='penjualans';
    protected $fillable =[
        'pelanggan_id','produk_id','kode_pembayaran','tanggal_penjualan','total_bayar','jumlah_bayar','kembalian','metode_pembayaran','status'
    ];

  public function getStatusLabel()
{
    if ($this->status == 'paid') {
        return '<div style="color: white; background-color: green; padding: 5px; border-radius: 5px; display: inline-block;">Lunas</div>';
    } elseif ($this->status == 'pending') {
        return '<div style="color: black; background-color: yellow; padding: 5px; border-radius: 5px; display: inline-block;">Menunggu</div>';
    } else {
        return '<div style="color: white; background-color: red; padding: 5px; border-radius: 5px; display: inline-block;">Gagal</div>';
    }
}


    // app/Models/Penjualan.php
public function pelanggan()
{
    return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
}


public function produk()
{
    return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
}
}
