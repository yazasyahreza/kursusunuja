<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Instruktur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstrukturController extends Controller
{
    public function index(Request $request)
    {
        $query = Instruktur::with('user');

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $instrukturs = $query->get();

        if ($request->ajax()) {
            return view('administrator.masters.instruktur.views.table', compact('instrukturs'))->render();
        }

        return view('administrator.masters.instruktur.views.index', compact('instrukturs'));
    }

    public function create()
    {
        return view('administrator.masters.instruktur.views.create');
    }

    /**
     * Simpan data instruktur baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'bidang_keahlian' => 'nullable|string|max:100',
            'no_telepon' => 'nullable|string|max:20',
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
                'role' => 'instruktur',
                'status' => 'active',
            ]);

            // Simpan instruktur
            Instruktur::create([
                'user_id' => $user->id_user,
                'bidang_keahlian' => $request->bidang_keahlian,
                'no_telepon' => $request->no_telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            DB::commit();

            return redirect()->route('master.instruktur.index')->with('success', 'Instruktur berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $instruktur = Instruktur::with('user')->findOrFail($id);
        return view('administrator.masters.instruktur.views.edit', compact('instruktur'));
    }

    /**
     * Update data instruktur.
     */
    public function update(Request $request, $id)
    {
        $instruktur = Instruktur::findOrFail($id);
        $user = User::where('id_user', $instruktur->user_id)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id_user . ',id_user',
            'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:6|confirmed',
            'bidang_keahlian' => 'nullable|string|max:100',
            'no_telepon' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
        ]);

        DB::beginTransaction();

        try {
            // Update user
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            // Update instruktur
            $instruktur->update([
                'bidang_keahlian' => $request->bidang_keahlian,
                'no_telepon' => $request->no_telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);

            DB::commit();

            return redirect()->route('master.instruktur.index')->with('success', 'Instruktur berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destrov($id)
    {
        $instruktur = Instruktur::findOrFail($id);
        $user = User::where('id_user', $instruktur->user_id)->first();

        DB::beginTransaction();
        try {
            // Hapus data user terlebih dahulu
            if ($user) {
                $user->delete();
            }

            // Kemudian hapus data instruktur
            $instruktur->delete();

            DB::commit();
            return redirect()->route('master.instruktur.index')->with('success', 'Instruktur berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
