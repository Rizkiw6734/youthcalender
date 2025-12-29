@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3 class="mb-4 fw-bold">Tambah Informasi</h3>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('informasi.store') }}" method="POST">
                    @csrf

                    {{-- Bulan --}}
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <select name="bulan_id"
                            class="form-select @error('bulan_id') is-invalid @enderror">
                            <option value="">-- Pilih Bulan --</option>

                            @foreach ($bulans as $b)
                                <option value="{{ $b->id }}"
                                    {{ old('bulan_id') == $b->id ? 'selected' : '' }}>
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
                        <input type="text" name="judul"
                            class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul') }}">

                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal"
                            class="form-control @error('tanggal') is-invalid @enderror"
                            value="{{ old('tanggal') }}">

                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keterangan</label>
                        <textarea name="keterangan" rows="5"
                            class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>

                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Aksi --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('informasi.index') }}"
                            class="btn btn-outline-secondary">
                            ← Kembali
                        </a>

                        <button class="btn btn-primary">
                            Simpan Informasi
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
