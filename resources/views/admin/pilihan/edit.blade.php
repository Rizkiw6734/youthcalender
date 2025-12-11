@extends('layouts.app')

@section('content')
<h4>Edit Pilihan Perjalanan</h4>

<form action="{{ route('pilihan.update', $pilihan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Bulan</label>
        <select name="bulan_id" class="form-control">
            @foreach($bulans as $b)
            <option value="{{ $b->id }}" {{ $pilihan->bulan_id == $b->id ? 'selected' : '' }}>
                {{ $b->nama_bulan }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nama Destinasi</label>
        <input type="text" name="nama_destinasi" class="form-control"
            value="{{ $pilihan->nama_destinasi }}">
    </div>

    <div class="mb-3">
        <label>Negara</label>
        <input type="text" name="negara" class="form-control"
            value="{{ $pilihan->negara }}">
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $pilihan->deskripsi }}</textarea>
    </div>

    <div class="mb-3">
        <label>Gambar</label><br>
        @if($pilihan->gambar)
        <img src="{{ asset('storage/' . $pilihan->gambar) }}" width="80" class="mb-2">
        @endif
        <input type="file" name="gambar" class="form-control">
    </div>

    <button class="btn btn-primary">Perbarui</button>
</form>
@endsection
