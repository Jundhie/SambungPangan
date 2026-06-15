<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengelolaPangan extends Model
{
    protected $table = 'pengelola_pangan';

    protected $primaryKey = 'id_pengelola';

    protected $fillable = [
        'id_user',
        'nama_usaha',
        'jenis_pengelolaan',
        'alamat',
        'dokumen_izin',
        'status_verifikasi',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_pengelola', 'id_pengelola');
    }

    public function isVerified(): bool
    {
        return $this->status_verifikasi === 'approved';
    }
}
