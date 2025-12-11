<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilihanPerjalanan extends Model
{
    protected $fillable = ['bulan_id','nama_destinasi','negara','deskripsi','gambar'];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }
}
