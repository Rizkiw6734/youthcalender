@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3 class="mb-4 fw-bold">Tambah Pilihan Perjalanan</h3>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <form action="{{ route('pilihan.store') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Destinasi --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Destinasi</label>
                        <input type="text" name="nama_destinasi"
                            class="form-control @error('nama_destinasi') is-invalid @enderror"
                            value="{{ old('nama_destinasi') }}">

                        @error('nama_destinasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Negara --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Negara</label>
                        <input type="text" name="negara"
                            class="form-control @error('negara') is-invalid @enderror"
                            value="{{ old('negara') }}">

                        @error('negara')
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

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar</label>
                        <input type="file" name="gambar"
                            class="form-control @error('gambar') is-invalid @enderror">

                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" rows="5"
                            class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Aksi --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('pilihan.index') }}"
                            class="btn btn-outline-secondary">
                            ← Kembali
                        </a>

                        <button class="btn btn-primary">
                            Simpan Perjalanan
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
