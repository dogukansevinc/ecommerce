<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urundetay extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function urun()
    {
        return $this->belongsTo(Urun::class);
    }
}
