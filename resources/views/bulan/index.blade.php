@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h3>Daftar Bulan</h3>
        <a href="{{ route('bulan.create') }}" class="btn btn-primary">+ Tambah Bulan</a>
    </div>

    <div class="row">
        @foreach($bulans as $bulan)
        <div class="col-md-3">
            <div class="card mb-3">
                @if($bulan->gambar)
                    <img src="{{ asset('storage/' . $bulan->gambar) }}" class="card-img-top" height="150">
                @endif
                <div class="card-body text-center">
                    <h5>{{ $bulan->nama_bulan }}</h5>

                    <a href="{{ route('bulan.edit', $bulan->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('bulan.destroy', $bulan->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus bulan ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
