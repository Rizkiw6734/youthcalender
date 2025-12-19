@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Data Pilihan Perjalanan</h4>
    <a href="{{ route('pilihan.create') }}" class="btn btn-primary">Tambah</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Destinasi</th>
            <th>Negara</th>
            <th>Gambar</th>
            <th>Tanggal</th>
            <th>Hari</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->bulan->nama_bulan }}</td>
            <td>{{ $d->nama_destinasi }}</td>
            <td>{{ $d->negara }}</td>
            <td>{{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') }}</td>
            <td>{{ $d->hari }}</td>
            <td>
                @if($d->gambar)
                <img src="{{ asset('storage/' . $d->gambar) }}" width="80">
                @endif
            </td>
            <td>
                <a href="{{ route('pilihan.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('pilihan.destroy', $d->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
