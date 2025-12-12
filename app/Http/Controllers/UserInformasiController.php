<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class UserInformasiController extends Controller
{
     public function index($bulan_id)
    {
        // ambil semua informasi berdasarkan bulan_id
        $informasis = Informasi::where('bulan_id', $bulan_id)->get();

        return view('user.informasi.index', compact('informasis'));
    }
}
