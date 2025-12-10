<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bulan;

class UserBulanController extends Controller
{
     public function index()
    {
        $bulan = Bulan::all();
        return view('user.bulan.index', compact('bulan'));
    }

    public function show($slug)
    {
        $bulan = Bulan::where('slug', $slug)->firstOrFail();

        return view('user.bulan.show', compact('bulan'));
    }

    public function listUser()
{
    $bulan = Bulan::all();
    return view('user.bulan.index', compact('bulan'));
}


public function artikelUser($slug)
{
    $bulan = Bulan::where('slug', $slug)->firstOrFail();
    $artikels = $bulan->artikels; // pastikan relasi sudah dibuat
    return view('user.bulan.artikel', compact('bulan', 'artikels'));
}

public function informasiUser($slug)
{
    $bulan = Bulan::where('slug', $slug)->firstOrFail();
    $informasi = $bulan->informasis;
    return view('user.bulan.informasi', compact('bulan', 'informasi'));
}

public function perjalananUser($slug)
{
    $bulan = Bulan::where('slug', $slug)->firstOrFail();
    $pilihan = $bulan->pilihanPerjalanans;
    return view('user.bulan.perjalanan', compact('bulan', 'pilihan'));
}

}
