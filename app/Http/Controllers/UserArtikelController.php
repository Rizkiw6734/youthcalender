<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Bulan;

class UserArtikelController extends Controller
{
    public function index($bulan_id)
{
    $artikels = Artikel::where('bulan_id', $bulan_id)->get();

    return view('user.artikel.index', compact('artikels'));
}

}
