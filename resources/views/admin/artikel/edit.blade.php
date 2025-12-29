@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3 class="mb-4 fw-bold">Edit Artikel</h3>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('artikel.update', $artikel->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Bulan --}}
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <select name="bulan_id" class="form-select @error('bulan_id') is-invalid @enderror">
                            <option value="">-- Pilih Bulan --</option>

                            @foreach ($bulans as $b)
                                <option value="{{ $b->id }}"
                                    {{ old('bulan_id', $artikel->bulan_id) == $b->id ? 'selected' : '' }}>
                                    {{ $b->nama_bulan }}
                                </option>
                            @endforeach
                        </select>

                        @error('bulan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $artikel->judul) }}">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal', $artikel->tanggal) }}">
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Isi --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Isi Artikel</label>
                        <textarea name="isi" rows="5" class="form-control @error('isi') is-invalid @enderror">{{ old('isi', $artikel->isi) }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Aksi --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('artikel.index') }}" class="btn btn-outline-secondary">
                            ← Kembali
                        </a>

                        <button class="btn btn-primary">
                            Perbarui Artikel
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- SweetAlert Error --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal menyimpan',
                text: 'Periksa kembali data yang Anda isi'
            });
        </script>
    @endif
@endsection
