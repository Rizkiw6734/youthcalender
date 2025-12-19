@extends('layouts.admin')

@section('title', 'Data Bulan')
@section('page-title', 'Manajemen Bulan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Daftar Bulan</h4>
        <button class="btn btn-primary" onclick="openTambahModal()">
            <i class="bi bi-plus-lg"></i> Tambah Bulan
        </button>

    </div>

    <div class="row">
        <div class="row">
    @forelse ($bulans as $bulan)
        <div class="col-6 col-md-3 mb-4">
            <div class="card shadow-sm">
                @if ($bulan->gambar)
                    <img src="{{ asset('storage/' . $bulan->gambar) }}"
                        class="card-img-top" height="150" style="object-fit: cover;">
                @endif

                <div class="card-body text-center">
                    <strong>{{ $bulan->nama_bulan }}</strong>

                    <div class="mt-3 d-flex justify-content-center gap-2">
                        <button class="btn btn-warning btn-sm"
                            onclick="openEditModal(
                                {{ $bulan->id }},
                                '{{ $bulan->nama_bulan }}',
                                '{{ $bulan->gambar }}'
                            )">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <form action="{{ route('bulan.destroy', $bulan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="hapusBulan(this)">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        {{-- JIKA DATA BULAN KOSONG --}}
        <div class="col-12">
            <div class="alert alert-info text-center py-5">
                <i class="bi bi-calendar-x fs-1 d-block mb-3"></i>
                <h5 class="mb-1">Belum ada data bulan</h5>
                <p class="mb-0 text-muted">
                    Silakan tambahkan data bulan terlebih dahulu.
                </p>
            </div>
        </div>
    @endforelse
</div>

    </div>

    {{-- MODAL TAMBAH  --}}
    <div class="modal fade" id="modalTambahBulan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-sm">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bulan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST" action="{{ route('bulan.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Bulan</label>
                            <input type="text" name="nama_bulan"
                                class="form-control @error('nama_bulan') is-invalid @enderror"
                                value="{{ old('nama_bulan') }}">

                            @error('nama_bulan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">

                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
<div class="modal fade" id="modalEditBulan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-sm">

            <div class="modal-header">
                <h5 class="modal-title">Edit Bulan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formEditBulan" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    {{-- NAMA BULAN --}}
                    <div class="mb-3">
                        <label>Nama Bulan</label>
                        <input type="text"
                            name="nama_bulan"
                            id="edit_nama_bulan"
                            class="form-control @error('nama_bulan') is-invalid @enderror">

                        @error('nama_bulan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- GAMBAR --}}
                    <div class="mb-3">
                        <label>Gambar</label>

                        {{-- PREVIEW --}}
                        <div class="mb-2">
                            <img id="preview_gambar_edit"
                                class="img-thumbnail"
                                style="max-height:150px; display:none;">
                        </div>

                        <input type="file"
                            name="gambar"
                            class="form-control @error('gambar') is-invalid @enderror"
                            onchange="previewEditGambar(this)">

                        @error('gambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>

        </div>
    </div>
</div>


    <script>
        function previewEditGambar(input) {
            const preview = document.getElementById('preview_gambar_edit');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>




    <script>
        let modalTambah;
        let modalEdit;

        document.addEventListener('DOMContentLoaded', function() {
            modalTambah = new bootstrap.Modal(
                document.getElementById('modalTambahBulan')
            );

            modalEdit = new bootstrap.Modal(
                document.getElementById('modalEditBulan')
            );

            // AUTO OPEN MODAL TAMBAH SAAT ERROR
            @if ($errors->any())
                modalTambah.show();
            @endif
        });

        function openTambahModal() {
            modalTambah.show();
        }

        function openEditModal(id, nama, gambar = null) {
            document.getElementById('formEditBulan').action = '/admin/bulan/' + id;
            document.getElementById('edit_nama_bulan').value = nama;

            const preview = document.getElementById('preview_gambar_edit');

            if (gambar) {
                preview.src = '/storage/' + gambar;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }

            modalEdit.show();
        }

        function hapusBulan(btn) {
            Swal.fire({
                title: 'Yakin?',
                text: 'Data bulan akan dihapus permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }
    </script>



@endsection
