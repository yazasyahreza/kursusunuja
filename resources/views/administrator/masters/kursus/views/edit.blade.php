@extends('administrator.layouts.app')

@section('this-page-style')
@endsection

@section('this-page-content')
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">Master <strong>Kursus</strong></h1>
            <a href="{{ route('master.kursus.index') }}" class="btn btn-secondary">
                <i class="align-middle" data-feather="arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card flex-fill">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Edit Data Kursus</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('master.kursus.update', $kursus->id_kursus) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    {{-- Judul Kursus --}}
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul Kursus</label>
                                        <input type="text" name="judul" id="judul"
                                            class="form-control @error('judul') is-invalid @enderror"
                                            value="{{ old('judul', $kursus->judul) }}" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Instruktur --}}
                                    <div class="mb-3">
                                        <label for="instruktur_id" class="form-label">Instruktur</label>
                                        <select name="instruktur_id" id="instruktur_id"
                                            class="form-select @error('instruktur_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Instruktur --</option>
                                            @foreach ($instrukturs as $instruktur)
                                                <option value="{{ $instruktur->id_instruktur }}"
                                                    {{ old('instruktur_id', $kursus->instruktur_id) == $instruktur->id_instruktur ? 'selected' : '' }}>
                                                    {{ $instruktur->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('instruktur_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Hari --}}
                                    <div class="mb-3">
                                        <label for="hari" class="form-label">Hari</label>
                                        <input type="text" name="hari" id="hari"
                                            class="form-control @error('hari') is-invalid @enderror"
                                            value="{{ old('hari', $kursus->hari) }}" required>
                                        @error('hari')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Gambar Kursus --}}
                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar Kursus (Opsional)</label>
                                        <input type="file" name="gambar" id="gambar"
                                            class="form-control @error('gambar') is-invalid @enderror" accept="image/*"
                                            onchange="previewGambar(event)">
                                        @error('gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        {{-- Preview Gambar --}}
                                        <div class="mt-3">
                                            <img id="gambar-preview" src="{{ asset($kursus->gambar) }}"
                                                alt="Preview Gambar"
                                                style="max-height: 200px; {{ $kursus->gambar ? '' : 'display: none;' }}"
                                                class="img-thumbnail">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    {{-- Durasi --}}
                                    <div class="mb-3">
                                        <label for="durasi" class="form-label">Durasi (dalam jam)</label>
                                        <input type="number" name="durasi" id="durasi"
                                            class="form-control @error('durasi') is-invalid @enderror"
                                            value="{{ old('durasi', $kursus->durasi) }}" required>
                                        @error('durasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Deskripsi --}}
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi (opsional)</label>
                                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5">{{ old('deskripsi', $kursus->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Update --}}
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('this-page-scripts')
    <script>
        function previewGambar(event) {
            const input = event.target;
            const preview = document.getElementById('gambar-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        x</script>
@endsection
