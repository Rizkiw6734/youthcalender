<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Bulan;
use Carbon\Carbon;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Filter bulan (urut berdasarkan ID)
    $bulans = Bulan::orderBy('id')->get();

    // Data artikel
    $artikels = Artikel::with('bulan')
        ->when($request->bulan, function ($query) use ($request) {
            $query->where('bulan_id', $request->bulan);
        })
        ->orderBy('tanggal', 'asc') // urut berdasarkan tanggal artikel
        ->get();

    return view('admin.artikel.index', compact('artikels', 'bulans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bulans = Bulan::all();
        return view('admin.artikel.create', compact('bulans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'bulan_id' => 'required',
        'judul' => 'required',
        'isi' => 'required',
        'tanggal' => 'required|date',
    ],[
        'bulan_id.required' => 'Bulan harus dipilih.',
        'judul.required' => 'Judul artikel harus diisi.',
        'isi.required' => 'Isi artikel harus diisi.',
        'tanggal.required' => 'Tanggal artikel harus diisi.',
        'tanggal.date' => 'Format tanggal tidak valid.',
    ]);

    // Set Bahasa Indonesia
    Carbon::setLocale('id');

    $tanggal = Carbon::parse($request->tanggal);

    Artikel::create([
        'bulan_id' => $request->bulan_id,
        'judul' => $request->judul,
        'isi' => $request->isi,
        'tanggal' => $request->tanggal,
        'hari' => $tanggal->translatedFormat('l'),
        // hasil: Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Minggu
    ]);

    return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
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
    public function edit(Artikel $artikel)
    {
        $bulans = Bulan::all();
        return view('admin.artikel.edit', compact('artikel', 'bulans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
{
    $request->validate([
        'bulan_id' => 'required',
        'judul' => 'required',
        'isi' => 'required',
        'tanggal' => 'required|date',
    ],[
        'bulan_id.required' => 'Bulan harus dipilih.',
        'judul.required' => 'Judul artikel harus diisi.',
        'isi.required' => 'Isi artikel harus diisi.',
        'tanggal.required' => 'Tanggal artikel harus diisi.',
        'tanggal.date' => 'Format tanggal tidak valid.',
    ]);

    $tanggal = Carbon::parse($request->tanggal);

    $artikel->update([
        'bulan_id' => $request->bulan_id,
        'judul' => $request->judul,
        'isi' => $request->isi,
        'tanggal' => $request->tanggal,
        'hari' => $tanggal->translatedFormat('l'),
    ]);

    return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
