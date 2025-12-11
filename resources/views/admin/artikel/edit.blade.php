@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Edit Artikel</h3>

    <form action="{{ route('artikel.update', $artikel->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Bulan</label>
            <select name="bulan_id" class="form-control">
                @foreach($bulans as $b)
                <option value="{{ $b->id }}" {{ $b->id == $artikel->bulan_id ? 'selected' : '' }}>
                    {{ $b->nama_bulan }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $artikel->judul }}">
        </div>

        <div class="mb-3">
            <label>Isi Artikel</label>
            <textarea name="isi" rows="5" class="form-control">{{ $artikel->isi }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
