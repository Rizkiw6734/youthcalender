@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="mb-3">Daftar Artikel</h3>

    <a href="{{ route('artikel.create') }}" class="btn btn-primary mb-3">+ Tambah Artikel</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>isi</th>
            <th>Hari</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($artikels as $a)
        <tr>
            <td>{{ $a->bulan->nama_bulan }}</td>
            <td>{{ $a->judul }}</td>
            <td>{{ \Carbon\Carbon::parse($a->tanggal)->translatedFormat('d F Y') }}</td>
            <td>{{ $a->isi}}</td>
            <td>{{ $a->hari }}</td>
            <td>
                <a href="{{ route('artikel.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('artikel.destroy', $a->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus artikel?')" class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
