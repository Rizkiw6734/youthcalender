@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Data Informasi</h3>

    <a href="{{ route('informasi.create') }}" class="btn btn-primary mb-3">+ Tambah Informasi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Judul</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($informasis as $info)
            <tr>
                <td>{{ $info->bulan->nama_bulan }}</td>
                <td>{{ $info->judul }}</td>
                <td>{{ $info->keterangan }}</td>
                <td>
                    <a href="{{ route('informasi.edit', $info->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('informasi.destroy', $info->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
