<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use App\Models\Kursus;
use App\Models\Peserta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah entitas
        $totalUsers = User::count();
        $totalInstruktur = Instruktur::count();
        $totalKursus = Kursus::count();
        $totalPeserta = Peserta::count();

        return view('administrator.dashboard.index', compact(
            'totalUsers',
            'totalInstruktur',
            'totalKursus',
            'totalPeserta',
        ));
    }

    public function data()
    {
        // Peserta per kursus
        $perKursus = DB::table('kursus')
            ->join('peserta_kursus', 'kursus.id_kursus', '=', 'peserta_kursus.kursus_id')
            ->select('kursus.judul', DB::raw('count(peserta_kursus.peserta_id) as total'))
            ->groupBy('kursus.judul')
            ->get();

        $perBulan = User::select(
            DB::raw('MONTHNAME(created_at) as bulan'),
            DB::raw('count(*) as total')
        )
            ->where('role', 'peserta')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('bulan')
            ->get();

        return response()->json([
            'perKursus' => $perKursus,
            'perBulan' => $perBulan,
        ]);
    }
}
