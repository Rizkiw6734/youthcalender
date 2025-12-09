@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Bulan</h3>

    <form action="{{ route('bulan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Bulan</label>
            <input type="text" name="nama_bulan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('bulan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
