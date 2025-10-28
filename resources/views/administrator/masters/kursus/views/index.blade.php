@extends('administrator.layouts.app')

@section('this-page-style')
@endsection

@section('this-page-content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Master <strong>Kursus</strong></h1>

        <form method="GET" action="{{ route('master.kursus.index') }}" class="mb-3 row g-2 align-items-end">

            {{-- Filter Judul Kursus --}}
            <div class="col-md-3">
                <label for="judul_id" class="form-label">Filter Kursus</label>
                <select name="judul_id" id="judul_id" class="form-control">
                    <option value="">-- Semua Kursus --</option>
                    @foreach ($allKursus as $k)
                        <option value="{{ $k->id_kursus }}" {{ request('judul_id') == $k->id_kursus ? 'selected' : '' }}>
                            {{ $k->judul }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Instruktur --}}
            <div class="col-md-3">
                <label for="instruktur_id" class="form-label">Filter Instruktur</label>
                <select name="instruktur_id" id="instruktur_id" class="form-control">
                    <option value="">-- Semua Instruktur --</option>
                    @foreach ($allInstruktur as $ins)
                        <option value="{{ $ins->user->id_user }}"
                            {{ request('instruktur_id') == $ins->user->id_user ? 'selected' : '' }}>
                            {{ $ins->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Hari --}}
            <div class="col-md-2">
                <label for="hari" class="form-label">Filter Hari</label>
                <select name="hari" id="hari" class="form-control">
                    <option value="">-- Semua Hari --</option>
                    <option value="senin" {{ request('hari') == 'senin' ? 'selected' : '' }}>Senin</option>
                    <option value="selasa" {{ request('hari') == 'selasa' ? 'selected' : '' }}>Selasa
                    </option>
                    <option value="rabu" {{ request('hari') == 'rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="khamis" {{ request('hari') == 'khamis' ? 'selected' : '' }}>Khamis
                    </option>
                    <option value="jumat" {{ request('hari') == 'jumat' ? 'selected' : '' }}>Jumat
                    </option>
                    <option value="sabtu" {{ request('hari') == 'sabtu' ? 'selected' : '' }}>Sabtu
                    </option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="align-middle" data-feather="search"></i> Cari
                </button>
            </div>

            <div class="col-md-2">
                <a href="{{ route('master.kursus.create') }}" class="btn btn-success w-100">
                    + Tambah Kursus
                </a>
            </div>
        </form>

        {{-- <div class="row">
            <div class="col-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-3">Data Kursus</h5>

                    </div> --}}

        {{-- 📋 Tabel Responsive --}}
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Judul Kursus</th>
                            <th>Instruktur</th>
                            <th>Hari</th>
                            <th>Durasi (jam)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kursus as $i => $item)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('master.kursus.edit', $item['id_kursus']) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="align-middle" data-feather="edit-2"></i> Edit</a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('master.kursus.destroy', $item['id_kursus']) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">
                                            <i class="align-middle" data-feather="trash"></i> Hapus</button>
                                    </form>
                                </td>
                                <td>{{ $item['judul'] }}</td>
                                <td>{{ $item['instruktur']['user']['name'] ?? '-' }}</td>
                                <td>{{ ucfirst($item['hari']) }}</td>
                                <td>{{ $item['durasi'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data kursus.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('this-page-scripts')
@endsection
