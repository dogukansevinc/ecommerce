<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kullanici extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'adsoyad', 'email', 'sifre','aktivasyon_anahtari','aktif_mi'
    ];

    protected $hidden = [
        'sifre', 'aktivasyon_anahtari'
    ];
    public function getAuthPassword()
    {
        return $this->sifre;
    }

}
