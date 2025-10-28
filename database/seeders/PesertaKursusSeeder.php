<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesertaKursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pesertas = DB::table('peserta')->get();
        $kursusList = DB::table('kursus')->pluck('id_kursus')->toArray();

        foreach ($pesertas as $peserta) {
            // Setiap peserta ikut 1-3 kursus berbeda secara acak
            $jumlahKursus = rand(1, 3);
            $kursusYangDiikuti = collect($kursusList)->random($jumlahKursus);

            foreach ($kursusYangDiikuti as $kursus_id) {
                // Random timestamp antara Juni - Agustus
                $created_at = Carbon::create(2025, rand(6, 8), rand(1, 28), rand(8, 18), rand(0, 59));

                // Random status: active atau inactive
                $status = ['active', 'inactive'][rand(0, 1)];

                DB::table('peserta_kursus')->insert([
                    'kursus_id' => $kursus_id,
                    'peserta_id' => $peserta->id_peserta,
                    'status' => $status,
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                ]);
            }
        }
    }
}
