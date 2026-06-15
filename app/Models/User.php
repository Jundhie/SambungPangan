<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function isAdministrator(): bool
    {
        return $this->role === 'administrator';
    }

    public function isRestoran(): bool
    {
        return $this->role === 'restoran';
    }

    public function isPengelolaPangan(): bool
    {
        return $this->role === 'pengelola_pangan';
    }

    public function mitraKuliner(): HasOne
    {
        return $this->hasOne(MitraKuliner::class, 'id_user', 'id_user');
    }

    public function pengelolaPangan(): HasOne
    {
        return $this->hasOne(PengelolaPangan::class, 'id_user', 'id_user');
    }

    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class, 'id_user', 'id_user');
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'id_user', 'id_user');
    }
}
