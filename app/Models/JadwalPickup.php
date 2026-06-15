<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPickup extends Model
{
    protected $table = 'jadwal_pickup';

    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_pesanan',
        'waktu_pickup',
        'status_pickup',
        'lokasi',
        'catatan',
    ];

    protected $casts = [
        'waktu_pickup' => 'datetime',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
