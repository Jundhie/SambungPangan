<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengelola_pangan', function (Blueprint $table) {
            $table->id('id_pengelola');
            $table->foreignId('id_user')->unique()->constrained('users', 'id_user')->cascadeOnDelete();
            $table->string('nama_usaha');
            $table->string('jenis_pengelolaan');
            $table->text('alamat');
            $table->string('dokumen_izin')->nullable();
            $table->enum('status_verifikasi', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->index('status_verifikasi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengelola_pangan');
    }
};
