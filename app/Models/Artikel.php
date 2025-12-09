<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $fillable = ['bulan_id','judul','isi','gambar'];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }
}
