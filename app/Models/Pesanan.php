<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesanan extends Model
{
    use SoftDeletes;

    protected $table = 'pesanan';

    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_pengelola',
        'id_listing',
        'waktu_pesan',
        'status_pesanan',
    ];

    protected $casts = [
        'waktu_pesan' => 'datetime',
    ];

    public function pengelolaPangan(): BelongsTo
    {
        return $this->belongsTo(PengelolaPangan::class, 'id_pengelola', 'id_pengelola');
    }

    public function listingLimbah(): BelongsTo
    {
        return $this->belongsTo(ListingLimbah::class, 'id_listing', 'id_listing');
    }

    public function jadwalPickup(): HasOne
    {
        return $this->hasOne(JadwalPickup::class, 'id_pesanan', 'id_pesanan');
    }

    public function transaksi(): HasOne
    {
        return $this->hasOne(Transaksi::class, 'id_pesanan', 'id_pesanan');
    }
}
