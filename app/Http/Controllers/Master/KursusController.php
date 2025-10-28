<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Instruktur;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KursusController extends Controller
{
    public function index(Request $request)
    {
        $query = Kursus::with('instruktur.user');

        // filter judul kursus
        if ($request->judul_id) {
            $query->where('id_kursus', $request->judul_id);
        }

        // filter instruktur
        if ($request->filled('instruktur_id')) {
            $query->whereHas('instruktur.user', function ($q) use ($request) {
                $q->where('id_user', $request->instruktur_id);
            });
        }

        // filter hari
        if ($request->hari) {
            $query->where('hari', $request->hari);
        }

        $kursus = $query->get();

        // data untuk dropdown filter
        $allKursus = Kursus::orderBy('judul', 'asc')->get();
        $allInstruktur = Instruktur::with('user')
            ->join('users', 'instruktur.user_id', '=', 'users.id_user')
            ->orderBy('users.name', 'asc')
            ->select('instruktur.*')
            ->get();

        return view('administrator.masters.kursus.views.index', compact('kursus', 'allKursus', 'allInstruktur'));
    }



    public function create()
    {
        $instrukturs = Instruktur::with('user')->get(); // Untuk dropdown pilihan instruktur
        return view('administrator.masters.kursus.views.create',  compact('instrukturs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'instruktur_id' => 'required|exists:instruktur,id_instruktur',
            'judul' => 'required|string|max:225',
            'deskripsi' => 'nullable|string',
            'durasi' => 'required|integer|min:1',
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'gambar' => 'required|image|max:3072',
        ]);

        try {
            $file = $request->file('gambar');
            $judulSlug = Str::slug($request->judul);
            $filename = $judulSlug . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/kursus');

            // Pastikan folder ada
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file->move($path, $filename);

            Kursus::create([
                'instruktur_id' => $request->instruktur_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'durasi' => $request->durasi,
                'hari' => $request->hari,
                'gambar' => 'uploads/kursus/' . $filename,
            ]);

            return redirect()->route('master.kursus.index')->with('success', 'Kursus berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan kursus: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $kursus = Kursus::findOrFail($id);
        $instrukturs = Instruktur::with('user')->get();
        return view('administrator.masters.kursus.views.edit', compact('kursus', 'instrukturs'));
    }

    public function update(Request $request, $id)
    {
        $kursus = Kursus::findOrFail($id);

        $request->validate([
            'instruktur_id' => 'required|exists:instruktur,id_instruktur',
            'judul' => 'required|string|max:225',
            'deskripsi' => 'nullable|string',
            'durasi' => 'required|integer|min:1',
            'hari' => 'required|string|max:50',
            'gambar' => 'nullable|image|max:3072',
        ]);

        try {
            $data = [
                'instruktur_id' => $request->instruktur_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'durasi' => $request->durasi,
                'hari' => $request->hari,
            ];

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $judulSlug = Str::slug($request->judul);
                $filename = $judulSlug . '.' . $file->getClientOriginalExtension();
                $path = public_path('uploads/kursus');

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // Hapus gambar lama jika ada
                if ($kursus->gambar && file_exists(public_path($kursus->gambar))) {
                    unlink(public_path($kursus->gambar));
                }

                $file->move($path, $filename);
                $data['gambar'] = 'uploads/kursus/' . $filename;
            }

            $kursus->update($data);

            return redirect()->route('master.kursus.index')->with('success', 'Kursus berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui kursus: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kursus = Kursus::findOrFail($id);
            $kursus->delete();

            return redirect()->route('master.struktur.index')->with('success', 'Kursus berhasil dihapus.');
        } catch (\Exception $e) {

            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function getKursus()
    {
        // sintaks query builder
        $kursus = DB::table('kursus')
            ->join('instruktur', 'kursus.instruktur_id', '=', 'instruktur.id_instruktur')
            ->join('users', 'instruktur.user_id', '=', 'users.id_user')
            ->select(
                'kursus.id_kursus',
                'kursus.judul',
                'kursus.deskripsi',
                'kursus.hari',
                'kursus.durasi',
                'kursus.gambar',
                'users.name as nama_instruktur',
                'instruktur.bidang_keahlian'
            )
            ->get();

        // Tambahkan fallback gambar jika kosong
        foreach ($kursus as $item) {
            $item->gambar = $item->gambar ?: "https://placehold.co/200x250?text=" . urlencode($item->judul);
        }

        return response()->json($kursus);
    }
}
