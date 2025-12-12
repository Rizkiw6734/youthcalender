@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Artikel Bulan Ini</h2>

    @forelse($artikels as $a)
        <div class="card mb-3">
            <div class="card-body">
                <h4>{{ $a->judul }}</h4>
                <p>{{ $a->isi }}</p>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada artikel untuk bulan ini.</p>
    @endforelse
</div>
@endsection
