<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Nama</th>
                <th>Bidang Keahlian</th>
                <th>No. Telepon</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($instrukturs as $i => $instruktur)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('master.instruktur.edit', $instruktur->id_instruktur) }}"
                            class="btn btn-sm btn-warning">
                            <i class="align-middle" data-feather="edit-2"></i> Edit</a>
                        {{-- Tombol Hapus --}}
                        <form action="{{ route('master.instruktur.destrov', $instruktur->id_instruktur) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                <i class="align-middle" data-feather="trash"></i> Hapus</button>
                        </form>
                    </td>
                    <td>{{ $instruktur->user->name ?? '-' }}</td>
                    <td>{{ $instruktur->bidang_keahlian ?? '-' }}</td>
                    <td>{{ $instruktur->no_telepon ?? '-' }}</td>
                    <td>{{ ucfirst($instruktur->jenis_kelamin) ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data instruktur.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
