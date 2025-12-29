<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Bulan;
use Carbon\Carbon;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    // Filter bulan (urut berdasarkan ID)
    $bulans = Bulan::orderBy('id')->get();

    // Data informasi
    $informasis = Informasi::with('bulan')
        ->when($request->bulan, function ($query) use ($request) {
            $query->where('bulan_id', $request->bulan);
        })
        ->orderBy('tanggal', 'asc') // urut tanggal (1 → 31)
        ->get();

    return view('admin.informasi.index', compact('informasis', 'bulans'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bulans = Bulan::all();
        return view('admin.informasi.create', compact('bulans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'bulan_id' => 'required|exists:bulans,id',
        'judul' => 'required',
        'keterangan' => 'required',
        'tanggal' => 'required|date',
    ],[
        'bulan_id.required' => 'Bulan harus dipilih.',
        'judul.required' => 'Judul informasi harus diisi.',
        'keterangan.required' => 'Keterangan informasi harus diisi.',
        'tanggal.required' => 'Tanggal informasi harus diisi.',
        'tanggal.date' => 'Format tanggal tidak valid.',
    ]);

    // Ambil tanggal dari input
    $tanggal = $request->tanggal;

    // Mengubah tanggal menjadi nama hari (Bahasa Indonesia)
    $hari = \Carbon\Carbon::parse($tanggal)->locale('id')->dayName;

    Informasi::create([
        'bulan_id'   => $request->bulan_id,
        'judul'      => $request->judul,
        'keterangan' => $request->keterangan,
        'tanggal'    => $tanggal,
        'hari'       => $hari,
    ]);

    return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan');
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
    public function edit(Informasi $informasi)
    {
        $bulans = Bulan::all();
        return view('admin.informasi.edit', compact('informasi', 'bulans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
{
    $request->validate([
        'bulan_id' => 'required|exists:bulans,id',
        'judul' => 'required',
        'keterangan' => 'required',
        'tanggal' => 'required|date',
    ],[
        'bulan_id.required' => 'Bulan harus dipilih.',
        'judul.required' => 'Judul informasi harus diisi.',
        'keterangan.required' => 'Keterangan informasi harus diisi.',
        'tanggal.required' => 'Tanggal informasi harus diisi.',
        'tanggal.date' => 'Format tanggal tidak valid.',
    ]);

    // Update hari otomatis sesuai tanggal baru
    $hari = \Carbon\Carbon::parse($request->tanggal)->translatedFormat('l');

    $informasi->update([
        'bulan_id' => $request->bulan_id,
        'judul' => $request->judul,
        'keterangan' => $request->keterangan,
        'tanggal' => $request->tanggal,
        'hari' => $hari,
    ]);

    return redirect()->route('informasi.index')->with('success', 'Informasi berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();
        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil dihapus');
    }
}
