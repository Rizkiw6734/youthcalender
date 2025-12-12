@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Edit Artikel</h3>

    <form action="{{ route('artikel.update', $artikel->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Bulan</label>
            <select name="bulan_id" class="form-control">
                @foreach ($bulans as $b)
                <option value="{{ $b->id }}" {{ $artikel->bulan_id == $b->id ? 'selected' : '' }}>
                    {{ $b->nama_bulan }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control"
                   value="{{ $artikel->judul }}">
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control"
                   value="{{ $artikel->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label>Hari</label>
            <input type="text" class="form-control"
                   value="{{ \Carbon\Carbon::parse($artikel->tanggal)->translatedFormat('l') }}"
                   disabled>
        </div>

        <div class="mb-3">
            <label>Isi Artikel</label>
            <textarea name="isi" rows="5" class="form-control">{{ $artikel->isi }}</textarea>
        </div>

        <button class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
