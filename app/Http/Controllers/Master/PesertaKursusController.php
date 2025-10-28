<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PesertaKursusController extends Controller
{
    // Tampilkan semua relasi peserta-kursus, dengan opsi filter
    public function index(Request $request)
    {
        $query = DB::table('peserta_kursus')
            ->join('peserta', 'peserta.id_peserta', '=', 'peserta_kursus.peserta_id')
            ->join('users', 'users.id_user', '=', 'peserta.user_id')
            ->join('kursus', 'kursus.id_kursus', '=', 'peserta_kursus.kursus_id')
            ->select(
                'peserta_kursus.*',
                'users.name as nama_peserta',
                'kursus.judul'
            );

        // Filter kursus
        if ($request->filled('kursus_id')) {
            $query->where('peserta_kursus.kursus_id', $request->kursus_id);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('peserta_kursus.status', $request->status);
        }

        // Filter peserta by ID
        if ($request->filled('peserta_id')) {
            $query->where('peserta_kursus.peserta_id', $request->peserta_id);
        }

        // Kalau mau filter berdasarkan nama peserta (search text):
        if ($request->filled('nama_peserta')) {
            $query->where('users.name', 'like', '%' . $request->nama_peserta . '%');
        }

        $data = $query->paginate(30)->withQueryString();

        // Untuk dropdown filter
        $kursuses = Kursus::orderBy('judul', 'asc')->get();
        $pesertas = Peserta::with('user')->orderBy('id_peserta', 'asc')->get();

        return view('administrator.masters.pesertaKursus.views.index', compact('data', 'kursuses', 'pesertas'));
    }


    // Tampilkan form tambah peserta ke kursus
    public function create(Request $request)
    {
        $pesertas = Peserta::with('user')
            ->join('users', 'users.id_user', '=', 'peserta.user_id')
            ->orderBy('users.name', 'asc')
            ->select('peserta.*')
            ->get();

        $kursuses = Kursus::orderBy('judul', 'asc')->get();

        // Ambil kursus_id dari query string (jika ada)
        $selectedKursusId = $request->query('kursus_id');

        return view('administrator.masters.pesertaKursus.views.create', compact('pesertas', 'kursuses', 'selectedKursusId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peserta_id' => [
                'required',
                'exists:peserta,id_peserta',
                Rule::unique('peserta_kursus')->where(function ($query) use ($request) {
                    return $query->where('kursus_id', $request->kursus_id)
                        ->where('peserta_id', $request->peserta_id);
                }),
            ],
            'kursus_id' => 'required|exists:kursus,id_kursus',
        ], [
            'peserta_id.unique' => 'Peserta sudah terdaftar dalam kursus ini.',
        ]);

        DB::beginTransaction();

        try {
            DB::table('peserta_kursus')->insert([
                'kursus_id' => $request->kursus_id,
                'peserta_id' => $request->peserta_id,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()->route('master.peserta-kursus.index')->with('success', 'Peserta berhasil ditambahkan ke kursus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = DB::table('peserta_kursus')->where('id_peserta_kursus', $id)->first();

        if (!$data) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        $pesertas = Peserta::with('user')
            ->join('users', 'users.id_user', '=', 'peserta.user_id')
            ->orderBy('users.name', 'asc')
            ->select('peserta.*')
            ->get();

        $kursuses = Kursus::orderBy('judul', 'asc')->get();

        return view('administrator.masters.pesertaKursus.views.edit', compact('data', 'pesertas', 'kursuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'peserta_id' => [
                'required',
                'exists:peserta,id_peserta',
                Rule::unique('peserta_kursus')->where(function ($query) use ($request, $id) {
                    return $query->where('kursus_id', $request->kursus_id)
                        ->where('peserta_id', $request->peserta_id)
                        ->where('id_peserta_kursus', '!=', $id);
                }),
            ],
            'kursus_id' => 'required|exists:kursus,id_kursus',
            'status' => 'required|in:active,inactive',
        ], [
            'peserta_id.unique' => 'Kombinasi kursus dan peserta sudah terdaftar.',
        ]);

        DB::beginTransaction();

        try {
            DB::table('peserta_kursus')
                ->where('id_peserta_kursus', $id)
                ->update([
                    'kursus_id' => $request->kursus_id,
                    'peserta_id' => $request->peserta_id,
                    'status' => $request->status,
                    'updated_at' => now(),
                ]);

            DB::commit();

            return redirect()->route('master.peserta-kursus.index')->with('success', 'Data peserta kursus berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id){
        try{
            DB::table('peserta_kursus')->where('id_peserta_kursus', $id)->delete();

            return redirect()->route('master.peserta-kursus.index')->with('success', 'Peserta kursus berhasil dihapus');
        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
