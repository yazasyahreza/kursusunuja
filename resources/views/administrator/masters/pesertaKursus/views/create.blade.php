@extends('administrator.layouts.app')

@section('this-page-style')
@endsection

@section('this-page-content')
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">Master <strong>Peserta Kursus</strong></h1>
            <a href="{{ route('master.peserta-kursus.index') }}" class="btn btn-secondary">
                <i class="align-middle" data-feather="arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tambah Peserta ke Kursus</h5>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('master.peserta-kursus.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- Kursus --}}
                                <div class="col-md-6 mb-3">
                                    <label for="kursus_id" class="form-label">Pilih Kursus</label>
                                    <select name="kursus_id" id="kursus_id"
                                        class="form-select @error('kursus_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Kursus --</option>
                                        @foreach ($kursuses as $kursus)
                                            <option value="{{ $kursus->id_kursus }}"
                                                {{ (old('kursus_id') ?? $selectedKursusId) == $kursus->id_kursus ? 'selected' : '' }}>
                                                {{ $kursus->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kursus_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Peserta --}}
                                <div class="col-md-6 mb-3">
                                    <label for="peserta_id" class="form-label">Pilih Peserta</label>
                                    <select name="peserta_id" id="peserta_id"
                                        class="form-select @error('peserta_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Peserta --</option>
                                        @foreach ($pesertas as $peserta)
                                            <option value="{{ $peserta->id_peserta }}"
                                                {{ old('peserta_id') == $peserta->id_peserta ? 'selected' : '' }}>
                                                {{ $peserta->user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('peserta_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tombol Simpan --}}
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('this-page-scripts')
@endsection
