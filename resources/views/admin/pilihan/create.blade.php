@extends('layouts.app')

@section('content')
<h4>Tambah Pilihan Perjalanan</h4>

<form action="{{ route('pilihan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Bulan</label>
        <select name="bulan_id" class="form-control">
            @foreach($bulans as $b)
            <option value="{{ $b->id }}">{{ $b->nama_bulan }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nama Destinasi</label>
        <input type="text" name="nama_destinasi" class="form-control">
    </div>

    <div class="mb-3">
        <label>Negara</label>
        <input type="text" name="negara" class="form-control">
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
