<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $primaryKey ='pelanggan_id';
    protected $table ='pelanggans';
    protected $fillable = [
        "nama_pelanggan",
        "alamat",
        "nomor_telepon"
    ];
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'pelanggan_id', 'pelanggan_id');
    }
}
