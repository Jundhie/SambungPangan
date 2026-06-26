<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakPesan extends Model
{
    use HasFactory;

    // Kasih tau Laravel nama tabel aslinya kalau beda dari standar (opsional kalau lu udah namain 'kontak_pesans')
    protected $table = 'kontak_pesan'; 
    
    // Kasih tau Laravel primary key-nya kalau bukan 'id'
    protected $primaryKey = 'id_pesan'; 

    // Izinkan kolom-kolom ini diisi data
    protected $fillable = [
        'nama_lengkap',
        'email',
        'pesan'
    ];
}