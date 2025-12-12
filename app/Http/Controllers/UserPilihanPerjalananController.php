<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PilihanPerjalanan;

class UserPilihanPerjalananController extends Controller
{
    public function index($bulan_id)
    {
        $pilihan = PilihanPerjalanan::where('bulan_id', $bulan_id)->get();

        return view('user.pilihan.index', compact('pilihan'));
    }
}
