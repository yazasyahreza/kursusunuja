@extends('administrator.layouts.app')

@section('this-page-style')
@endsection

@section('this-page-content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Master <strong>Peserta Kursus</strong></h1>
        {{-- Filter --}}
        <form method="GET" action="{{ route('master.peserta-kursus.index') }}" class="mb-3 row g-2 align-items-end">
            <div class="col-md-3">
                <label for="kursus_id" class="form-label">Filter Peserta</label>
                <select name="peserta_id" id="peserta_id" class="form-control">
                    <option value="">-- Semua Peserta --</option>
                    @foreach ($pesertas as $peserta)
                        <option value="{{ $peserta->id_peserta }}"
                            {{ request('peserta_id') == $peserta->id_peserta ? 'selected' : '' }}>
                            {{ $peserta->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="kursus_id" class="form-label">Filter Kursus</label>
                <select name="kursus_id" id="kursus_id" class="form-control">
                    <option value="">-- Semua Kursus --</option>
                    @foreach ($kursuses as $kursus)
                        <option value="{{ $kursus->id_kursus }}"
                            {{ request('kursus_id') == $kursus->id_kursus ? 'selected' : '' }}>
                            {{ $kursus->judul }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="status" class="form-label">Filter Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">-- Semua Status --</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="align-middle" data-feather="search"></i> Cari</button>
            </div>

            <div class="col-md-2 text-end">
                <a href="{{ route('master.peserta-kursus.create') }}" class="btn btn-success w-100">+ Tambah Peserta
                    Kursus</a>
            </div>
        </form>

        {{-- 📋 Tabel Data --}}
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Kursus</th>
                            <th>Peserta</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $i => $item)
                            <tr>
                                <td>{{ $data->firstItem() + $i }}</td>
                                <td>
                                    <a href="{{ route('master.peserta-kursus.edit', $item->id_peserta_kursus) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="align-middle" data-feather="edit-2"></i> Edit
                                    </a>

                                    <form action="{{ route('master.peserta-kursus.destroy', $item->id_peserta_kursus) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->nama_peserta }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data peserta kursus.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="btn-toolbar mt-4" role="toolbar" aria-label="Toolbar with button groups">

                    {{-- Tombol Previous --}}
                    <div class="btn-group me-2" role="group" aria-label="First group">
                        @if ($data->onFirstPage())
                            <button type="button" class="btn btn-secondary" disabled>
                                <i class="align-middle" data-feather="chevron-left"></i>
                            </button>
                        @else
                            <a href="{{ $data->previousPageUrl() }}" class="btn btn-primary">
                                <i class="align-middle" data-feather="chevron-left"></i>
                            </a>
                        @endif
                    </div>

                    {{-- Nomor Halaman --}}
                    <div class="btn-group me-2" role="group" aria-label="Second group">
                        @for ($i = 1; $i <= $data->lastPage(); $i++)
                            @if ($i == $data->currentPage())
                                <button type="button" class="btn btn-primary">{{ $i }}</button>
                            @else
                                <a href="{{ $data->url($i) }}" class="btn btn-outline-primary">{{ $i }}</a>
                            @endif
                        @endfor
                    </div>

                    {{-- Tombol Next --}}
                    <div class="btn-group" role="group" aria-label="Third group">
                        @if ($data->hasMorePages())
                            <a href="{{ $data->nextPageUrl() }}" class="btn btn-primary">
                                <i class="align-middle" data-feather="chevron-right"></i>
                            </a>
                        @else
                            <button type="button" class="btn btn-secondary" disabled>
                                <i class="align-middle" data-feather="chevron-right"></i>
                            </button>
                        @endif
                    </div>

                </div>
                <div class="mt-2 text-muted">
                    Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }} dari {{ $data->total() }} data
                </div>
            </div>
        </div>
    @endsection

    @section('this-page-scripts')
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
    @endsection
