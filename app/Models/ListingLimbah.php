<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListingLimbah extends Model
{
    use SoftDeletes;

    protected $table = 'listing_limbah';

    protected $primaryKey = 'id_listing';

    protected $fillable = [
        'id_mitra',
        'id_kategori',
        'berat_barang',
        'waktu_mulai',
        'waktu_berakhir',
        'deskripsi',
        'harga',
    ];

    protected $casts = [
        'berat_barang' => 'decimal:2',
        'harga' => 'decimal:2',
        'waktu_mulai' => 'datetime',
        'waktu_berakhir' => 'datetime',
    ];

    public function mitraKuliner(): BelongsTo
    {
        return $this->belongsTo(MitraKuliner::class, 'id_mitra', 'id_mitra');
    }

    public function kategoriLimbah(): BelongsTo
    {
        return $this->belongsTo(KategoriLimbah::class, 'id_kategori', 'id_kategori');
    }

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_listing', 'id_listing');
    }

    public function hasActivePesanan(): bool
    {
        return $this->pesanan()
            ->whereIn('status_pesanan', ['pending', 'confirmed'])
            ->exists();
    }
}
