<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urun extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function kategoriler()
    {
       return $this->belongsToMany(Kategori::class,'urunkats');
    }

    public function detay()
    {
        return $this->hasOne(Urundetay::class);
    }
}
