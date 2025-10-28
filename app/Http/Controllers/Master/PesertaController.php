<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = Peserta::with('user');

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $pesertas = $query->get();

        if ($request->ajax()) {
            return view('administrator.masters.peserta.views.table', compact('pesertas'))->render();
        }

        return view('administrator.masters.peserta.views.index', compact('pesertas'));
    }

    public function create()
    {
        return view('administrator.masters.peserta.views.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'username' => 'required|string|max:225|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
        ]);

        DB::beginTransaction();

        try {
            // Simpan user
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'peserta',
                'status' => 'active',
            ]);

            // Simpan peserta
            Peserta::create([
                'user_id' => $user->id_user,
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            DB::commit();

            return redirect()->route('master.peserta.index')->with('success', 'Peserta berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $peserta = Peserta::with('user')->findOrFail($id);
        return view('administrator.masters.peserta.views.edit', compact('peserta'));
    }

    public function update(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);
        $user = User::where('id_user', $peserta->user_id)->first();

        $request->validate([
            'name' => 'required|string|max:225',
            'username' => 'required|string|max:225|unique:users,username,' . $user->id_user . ',id_user',
            'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:6|confirmed',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
        ]);

        DB::beginTransaction();

        try {
            // Simpan user
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            // Simpan peserta
            $peserta->update([
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            DB::commit();

            return redirect()->route('master.peserta.index')->with('success', 'Peserta berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $user = User::where('id_user', $peserta->user_id)->first();

        DB::beginTransaction();
        try {
            // Hapus data user terlebih dahulu
            if ($user) {
                $user->delete();
            }

            // Kemudian hapus data peserta
            $peserta->delete();

            DB::commit();
            return redirect()->route('master.peserta.index')->with('success', 'Peserta berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
