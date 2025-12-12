<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
     protected $fillable = ['bulan_id','judul','keterangan','tanggal','hari'];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }
}
