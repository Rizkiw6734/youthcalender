@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Bulan</h3>

    <form action="{{ route('bulan.update', $bulan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Bulan</label>
            <input type="text" name="nama_bulan" value="{{ $bulan->nama_bulan }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Gambar</label><br>
            @if($bulan->gambar)
                <img src="{{ asset('storage/' . $bulan->gambar) }}" width="120" class="mb-2">
            @endif
            <input type="file" name="gambar" class="form-control">
        </div>

        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('bulan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
