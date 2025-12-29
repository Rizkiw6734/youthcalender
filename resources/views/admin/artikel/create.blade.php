@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0">
                    <div class="card-header fw-semibold">
                        Tambah Artikel
                    </div>

                    <div class="card-body">
                        <form action="{{ route('artikel.store') }}" method="POST">
                            @csrf

                            {{-- Bulan --}}
                            <div class="mb-3">
                                <label class="form-label">Bulan</label>
                                <select name="bulan_id" class="form-select @error('bulan_id') is-invalid @enderror">
                                    <option value="">-- Pilih Bulan --</option>
                                    @foreach ($bulans as $b)
                                        <option value="{{ $b->id }}"
                                            {{ old('bulan_id') == $b->id ? 'selected' : '' }}>
                                            {{ $b->nama_bulan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bulan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Judul --}}
                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul" value="{{ old('judul') }}"
                                    class="form-control @error('judul') is-invalid @enderror">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal --}}
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                                    class="form-control @error('tanggal') is-invalid @enderror">
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Isi --}}
                            <div class="mb-3">
                                <label class="form-label">Isi Artikel</label>
                                <textarea name="isi" rows="5" class="form-control @error('isi') is-invalid @enderror">{{ old('isi') }}</textarea>
                                @error('isi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('artikel.index') }}" class="btn btn-outline-secondary">
                                    ← Kembali
                                </a>

                                <button class="btn btn-primary">
                                    Simpan Artikel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
