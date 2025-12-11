<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Bulan;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasis = Informasi::with('bulan')->latest()->get();
        return view('admin.informasi.index', compact('informasis'));
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
        ]);

        Informasi::create($request->all());

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
        ]);

        $informasi->update($request->all());

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
