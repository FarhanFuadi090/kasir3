<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGambarToProduksTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('produks', 'gambar')) { // Cek jika kolom belum ada
            Schema::table('produks', function (Blueprint $table) {
                $table->string('gambar')->nullable()->after('stok');
            });
        }
    }

    /**
     * Rollback migrasi.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('produks', 'gambar')) { // Cek sebelum menghapus agar tidak error
            Schema::table('produks', function (Blueprint $table) {
                $table->dropColumn('gambar');
            });
        }
    }
}
