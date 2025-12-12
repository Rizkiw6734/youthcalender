@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Informasi</h3>

    <form action="{{ route('informasi.store') }}" method="POST">
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
            <label>Judul</label>
            <input type="text" name="judul" class="form-control">
        </div>

        <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal</label>
    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
</div>


        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
