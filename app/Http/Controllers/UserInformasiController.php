<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Bulan;

class UserInformasiController extends Controller
{
    public function index($bulan_id)
{
    // ambil data bulan
    $bulan = Bulan::findOrFail($bulan_id);

    // ambil informasi berdasarkan bulan
    // diurutkan berdasarkan tanggal (awal → akhir)
    $informasis = Informasi::where('bulan_id', $bulan_id)
        ->orderBy('tanggal', 'asc')
        ->get();

    return view('user.informasi.index', compact('bulan', 'informasis'));
}
}
