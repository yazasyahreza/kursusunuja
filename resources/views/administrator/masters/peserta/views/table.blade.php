<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Nama</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesertas as $i => $peserta)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        {{-- Tombol Edit --}}
                        <a href="{{ route('master.peserta.edit', $peserta->id_peserta) }}" class="btn btn-sm btn-warning">
                            <i class="align-middle" data-feather="edit-2"></i> Edit
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('master.peserta.destroy', $peserta->id_peserta) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                <i class="align-middle" data-feather="trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                    <td>{{ $peserta->user->name ?? '-' }}</td>
                    <td>{{ $peserta->no_telepon ?? '-' }}</td>
                    <td>{{ $peserta->alamat ?? '-' }}</td>
                    <td>{{ ucfirst($peserta->jenis_kelamin) ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data peserta.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
