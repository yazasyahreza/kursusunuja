@extends('administrator.layouts.app')

@section('this-page-style')
@endsection

@section('this-page-content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Master <strong>Peserta</strong></h1>

        <div class="row">
            <div class="col-12">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-3">Data Peserta</h5>
                        <form action="{{ route('master.peserta.index') }}" method="GET">
                            <div class="row g-2 align-items-center">
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="text" id="searchInput" name="search" class="form-control"
                                            placeholder="Cari berdasarkan nama..." value="{{ request('search') }}"
                                            autocomplete="off">
                                        <span class="input-group-text bg-white">
                                            <i data-feather="search"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3 text-end">
                                    <a href="{{ route('master.peserta.create') }}" class="btn btn-primary w-100">
                                        + Tambah Peserta
                                    </a>
                                </div>
                            </div>
                        </form>

                        {{-- <div class="d-flex">
                            <form action="{{ route('master.peserta.index') }}" method="GET" class="d-flex me-2">
                                <input type="text" name="search" class="form-control form-control-sm"
                                    placeholder="Cari berdasarkan nama..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-sm btn-secondary ms-2">Cari</button>
                            </form>

                            <a href="{{ route('master.peserta.create') }}" class="btn btn-primary">
                                + Tambah Peserta
                            </a>
                        </div> --}}
                    </div>

                    {{-- 📋 Tabel Responsive --}}
                    <div id="tableData">
                        @include('administrator.masters.peserta.views.table', [
                            'pesertas' => $pesertas,
                        ])
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('this-page-scripts')
    <script>
        let debounceTimer;
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('keyup', function() {
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(() => {
                let query = this.value;

                fetch("{{ route('master.peserta.index') }}?search=" + query, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('tableData').innerHTML = data;
                        feather.replace(); // re-render icon
                    });
            }, 300); // jeda 300ms biar tidak terlalu cepat request
        });
    </script>
@endsection
