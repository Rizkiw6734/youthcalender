@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Informasi Bulan Ini</h3>

    @if($informasis->count() == 0)
        <div class="alert alert-warning">
            Belum ada informasi untuk bulan ini.
        </div>
    @else
        @foreach($informasis as $info)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $info->judul }}</h5>
                    <p class="card-text">{{ $info->keterangan }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
