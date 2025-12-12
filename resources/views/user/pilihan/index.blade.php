@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Pilihan Perjalanan Bulan Ini</h3>

    @if($pilihan->count() == 0)
        <div class="alert alert-info">
            Belum ada pilihan perjalanan untuk bulan ini.
        </div>
    @endif

    <div class="row">
        @foreach($pilihan as $p)
        <div class="col-md-4 mb-4">
            <div class="card h-100">

                @if($p->gambar)
                <img src="{{ asset('storage/' . $p->gambar) }}" class="card-img-top" alt="gambar">
                @else
                <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="no image">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $p->nama_destinasi }}</h5>

                    @if($p->negara)
                    <p class="text-muted mb-1"><strong>Negara:</strong> {{ $p->negara }}</p>
                    @endif

                    <p class="card-text">{{ $p->deskripsi }}</p>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
