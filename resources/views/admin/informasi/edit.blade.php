@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Informasi</h3>

    <form action="{{ route('informasi.update', $informasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Bulan</label>
            <select name="bulan_id" class="form-control">
                @foreach($bulans as $b)
                <option value="{{ $b->id }}" {{ $b->id == $informasi->bulan_id ? 'selected' : '' }}>
                    {{ $b->nama_bulan }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $informasi->judul }}">
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $informasi->keterangan }}</textarea>
        </div>

        <button class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
