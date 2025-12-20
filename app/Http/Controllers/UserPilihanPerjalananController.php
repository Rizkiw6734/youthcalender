<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PilihanPerjalanan;
use App\Models\Bulan;

class UserPilihanPerjalananController extends Controller
{
    public function index($bulan_id)
{
    // ambil data bulan
    $bulan = Bulan::findOrFail($bulan_id);

    // ambil pilihan perjalanan berdasarkan bulan
    // diurutkan berdasarkan tanggal (awal → akhir)
    $pilihan = PilihanPerjalanan::where('bulan_id', $bulan_id)
        ->orderBy('tanggal', 'asc')
        ->get();

    return view('user.pilihan.index', compact('bulan', 'pilihan'));
}

}
