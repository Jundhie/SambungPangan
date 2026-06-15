<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pickup', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('id_pesanan')->unique()->constrained('pesanan', 'id_pesanan')->cascadeOnDelete();
            $table->dateTime('waktu_pickup');
            $table->enum('status_pickup', ['scheduled', 'picked_up', 'cancelled'])->default('scheduled');
            $table->string('lokasi');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index('status_pickup');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pickup');
    }
};
