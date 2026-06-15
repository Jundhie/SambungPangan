<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriLimbah extends Model
{
    protected $table = 'kategori_limbah';

    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'peruntukan',
        'keterangan',
    ];

    public function listingLimbah(): HasMany
    {
        return $this->hasMany(ListingLimbah::class, 'id_kategori', 'id_kategori');
    }
}
