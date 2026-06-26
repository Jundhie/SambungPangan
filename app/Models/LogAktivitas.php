<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id_log';
    public $timestamps = false; // ← tambah ini

    protected $fillable = [
        'id_user',
        'aksi',
        'keterangan',
        'waktu',        // ← tambah ini juga
    ];

    protected $casts = [
        'waktu' => 'datetime', // ← tambah ini
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}