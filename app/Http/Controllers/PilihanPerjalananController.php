<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PilihanPerjalanan;
use App\Models\Bulan;
use Illuminate\Support\Facades\Storage;

class PilihanPerjalananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Data bulan (urut berdasarkan ID)
    $bulans = Bulan::orderBy('id')->get();

    // Data pilihan perjalanan
    $data = PilihanPerjalanan::with('bulan')
        ->when($request->bulan, function ($query) use ($request) {
            $query->where('bulan_id', $request->bulan);
        })
        ->orderBy('tanggal', 'asc') // urut tanggal (1 → 31)
        ->get();

    return view('admin.pilihan.index', compact('data', 'bulans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bulans = Bulan::all();
        return view('admin.pilihan.create', compact('bulans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bulan_id' => 'required',
            'nama_destinasi' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:2048',
            'negara' => 'required',
        ],[
            'bulan_id.required' => 'Bulan harus dipilih.',
            'nama_destinasi.required' => 'Nama destinasi harus diisi.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'gambar.max'   => 'Ukuran gambar maksimal 2 MB.',
            'negara.required' => 'Negara harus diisi.',
        ]);

        // Ambil tanggal dari input
        $tanggal = $request->tanggal;

        // Mengubah tanggal menjadi nama hari (Bahasa Indonesia)
        $hari = \Carbon\Carbon::parse($tanggal)->locale('id')->dayName;

        $gambar = null;

        // UPLOAD menggunakan storage manual public_html/storage
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('pilihan', env('FILESYSTEM_DISK'));
        }

        PilihanPerjalanan::create([
            'bulan_id' => $request->bulan_id,
            'nama_destinasi' => $request->nama_destinasi,
            'negara' => $request->negara,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
            'tanggal' => $tanggal,
            'hari'=> $hari,
        ]);

        return redirect()->route('pilihan.index')->with('success', 'Data berhasil ditambahkan!');
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
    public function edit(PilihanPerjalanan $pilihan)
    {
        $bulans = Bulan::all();
        return view('admin.pilihan.edit', compact('pilihan', 'bulans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PilihanPerjalanan $pilihan)
    {
         $request->validate([
        'bulan_id' => 'required',
        'nama_destinasi' => 'required',
        'deskripsi' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'tanggal' => 'required|date',
        'negara' => 'required',
    ],[
        'bulan_id.required' => 'Bulan harus dipilih.',
        'nama_destinasi.required' => 'Nama destinasi harus diisi.',
        'deskripsi.required' => 'Deskripsi harus diisi.',
        'tanggal.required' => 'Tanggal harus diisi.',
        'tanggal.date' => 'Format tanggal tidak valid.',
        'gambar.image' => 'File yang diunggah harus berupa gambar.',
        'gambar.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
        'gambar.max'   => 'Ukuran gambar maksimal 2 MB.',
        'negara.required' => 'Negara harus diisi.',
    ]);

    // Update hari otomatis sesuai tanggal baru
    $hari = \Carbon\Carbon::parse($request->tanggal)->translatedFormat('l');

    // simpan nama file lama
    $oldGambar = $pilihan->gambar;

    // default: tetap pakai gambar lama
    $gambar = $oldGambar;

    // jika ada upload baru, hapus file lama lalu simpan file baru
    if ($request->hasFile('gambar')) {
        $disk = env('FILESYSTEM_DISK');
        // hapus file lama kalau ada
        if ($oldGambar && Storage::disk($disk)->exists($oldGambar)) {
            Storage::disk($disk)->delete($oldGambar);
        }
        // simpan file baru ke folder 'perjalanan' pada disk yg dipilih
        $gambar = $request->file('gambar')->store('pilihan', $disk);
    }

    $pilihan->update([
        'bulan_id' => $request->bulan_id,
        'nama_destinasi' => $request->nama_destinasi,
        'negara' => $request->negara,
        'deskripsi' => $request->deskripsi,
        'gambar' => $gambar,
        'tanggal' => $request->tanggal,
        'hari' => $hari,
    ]);

    return redirect()->route('pilihan.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PilihanPerjalanan $pilihan)
    {
        $disk = env('FILESYSTEM_DISK');

    // hapus file gambar di storage jika ada
    if ($pilihan->gambar && Storage::disk($disk)->exists($pilihan->gambar)) {
        Storage::disk($disk)->delete($pilihan->gambar);
    }

    // lalu hapus record dari DB
    $pilihan->delete();

    return redirect()->route('pilihan.index')->with('success', 'Data berhasil dihapus!');
    }
}
