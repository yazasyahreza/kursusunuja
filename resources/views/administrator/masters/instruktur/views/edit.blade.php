@extends('administrator.layouts.app')

@section('this-page-style')
@endsection

@section('this-page-content')
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">Master <strong>Instruktur</strong></h1>
            <a href="{{ route('master.instruktur.index') }}" class="btn btn-secondary">
                <i class="align-middle" data-feather="arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card flex-fill">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Edit Data Instruktur</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('master.instruktur.update', $instruktur->id_instruktur) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- Kolom Kiri --}}
                                <div class="col-md-6">
                                    {{-- Nama --}}
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $instruktur->user->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Username --}}
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" id="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username', $instruktur->user->username) }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $instruktur->user->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Password (Opsional) --}}
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password (Kosongkan jika tidak
                                            diganti)</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Konfirmasi Password --}}
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control">
                                    </div>
                                </div>

                                {{-- Kolom Kanan --}}
                                <div class="col-md-6">
                                    {{-- Bidang Keahlian --}}
                                    <div class="mb-3">
                                        <label for="bidang_keahlian" class="form-label">Bidang Keahlian</label>
                                        <input type="text" name="bidang_keahlian" id="bidang_keahlian"
                                            class="form-control @error('bidang_keahlian') is-invalid @enderror"
                                            value="{{ old('bidang_keahlian', $instruktur->bidang_keahlian) }}">
                                        @error('bidang_keahlian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- No Telepon --}}
                                    <div class="mb-3">
                                        <label for="no_telepon" class="form-label">No. Telepon</label>
                                        <input type="text" name="no_telepon" id="no_telepon"
                                            class="form-control @error('no_telepon') is-invalid @enderror"
                                            value="{{ old('no_telepon', $instruktur->no_telepon) }}">
                                        @error('no_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Jenis Kelamin --}}
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin"
                                            class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                            <option value="">-- Pilih --</option>
                                            <option value="laki-laki"
                                                {{ old('jenis_kelamin', $instruktur->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="perempuan"
                                                {{ old('jenis_kelamin', $instruktur->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Submit --}}
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
@endsection
