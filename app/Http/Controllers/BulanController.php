<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bulan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bulans = Bulan::all();
        return view('bulan.index', compact('bulans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bulan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bulan' => 'required',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('bulan', env('FILESYSTEM_DISK'));
        }

        Bulan::create([
            'nama_bulan' => $request->nama_bulan,
            'slug' => Str::slug($request->nama_bulan),
            'gambar' => $gambar
        ]);

        return redirect()->route('bulan.index')->with('success', 'Bulan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bulan $bulan)
    {
        return view('bulan.edit', compact('bulan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bulan $bulan)
{
    $request->validate([
        'nama_bulan' => 'required',
        'gambar' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $gambar = $bulan->gambar;

    // Jika user upload gambar baru
    if ($request->hasFile('gambar')) {

        // Hapus gambar lama jika ada
        if ($bulan->gambar && Storage::disk(env('FILESYSTEM_DISK'))->exists($bulan->gambar)) {
            Storage::disk(env('FILESYSTEM_DISK'))->delete($bulan->gambar);
        }

        // Simpan gambar baru
        $gambar = $request->file('gambar')->store('bulan',env('FILESYSTEM_DISK'));
    }

    $bulan->update([
        'nama_bulan' => $request->nama_bulan,
        'slug' => Str::slug($request->nama_bulan),
        'gambar' => $gambar
    ]);

    return redirect()->route('bulan.index')->with('success', 'Bulan berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bulan $bulan)
    {
    if ($bulan->gambar && Storage::disk(env('FILESYSTEM_DISK'))->exists($bulan->gambar)) {
        Storage::disk(env('FILESYSTEM_DISK'))->delete($bulan->gambar);
    }

    $bulan->delete();

    return redirect()->route('bulan.index')->with('success', 'Bulan berhasil dihapus');
    }
}
