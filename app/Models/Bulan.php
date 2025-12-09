<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulan extends Model
{
     protected $fillable = ['nama_bulan', 'slug', 'gambar'];

    public function artikels()
    {
        return $this->hasMany(Artikel::class);
    }

    public function informasis()
    {
        return $this->hasMany(Informasi::class);
    }

    public function pilihanPerjalanans()
    {
        return $this->hasMany(PilihanPerjalanan::class);
    }
}
