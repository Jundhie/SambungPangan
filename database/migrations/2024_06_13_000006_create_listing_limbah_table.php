<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listing_limbah', function (Blueprint $table) {
            $table->id('id_listing');
            $table->foreignId('id_mitra')->constrained('mitra_kuliner', 'id_mitra')->cascadeOnDelete();
            $table->foreignId('id_kategori')->constrained('kategori_limbah', 'id_kategori')->restrictOnDelete();
            $table->decimal('berat_barang', 10, 2);
            $table->dateTime('waktu_tersedia'); // Ganti dari waktu_mulai & berakhir
            $table->enum('status_listing', ['tersedia', 'dipesan', 'kadaluarsa'])->default('tersedia');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Index disesuaikan dengan kolom baru
            $table->index(['id_mitra', 'waktu_tersedia']);
            $table->index('id_kategori');
            $table->index('status_listing');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listing_limbah');
    }
};