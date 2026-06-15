<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_pengelola')->constrained('pengelola_pangan', 'id_pengelola')->restrictOnDelete();
            $table->foreignId('id_listing')->constrained('listing_limbah', 'id_listing')->restrictOnDelete();
            $table->dateTime('waktu_pesan');
            $table->enum('status_pesanan', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id_pengelola', 'status_pesanan']);
            $table->index('id_listing');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
