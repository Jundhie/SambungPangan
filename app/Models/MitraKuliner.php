<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MitraKuliner extends Model
{
    protected $table = 'mitra_kuliner';

    protected $primaryKey = 'id_mitra';

    protected $fillable = [
        'id_user',
        'nama_usaha',
        'alamat',
        'jenis_usaha',
        'dokumen_izin',
        'status_verifikasi',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function listingLimbah(): HasMany
    {
        return $this->hasMany(ListingLimbah::class, 'id_mitra', 'id_mitra');
    }

    public function isVerified(): bool
    {
        return $this->status_verifikasi === 'approved';
    }
}
