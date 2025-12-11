<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    protected $fillable = ['bulan_id','judul','isi'];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }
}
