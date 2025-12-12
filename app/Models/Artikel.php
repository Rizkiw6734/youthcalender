<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Artikel extends Model
{
    protected $fillable = ['bulan_id','judul','isi','tanggal','hari'];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }

    public function getHariAttribute()
{
    return Carbon::parse($this->tanggal)->translatedFormat('l');
}
}
