<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instrukturs = DB::table('instruktur')->get();

        foreach ($instrukturs as $index => $instruktur){
            DB::table('kursus')->insert([
                'instruktur_id' => $instruktur->id_instruktur,  
                'judul' => "Kursus {$instruktur->id_instruktur}",  
                'deskripsi' => "Deskripsi kursus ke-{$instruktur->id_instruktur}",  
                'durasi' => rand(2, 5) * 10, // contoh durasi  
                'hari' => 'Senin - Jumat',  
                'created_at' => now(),  
                'updated_at' => now(),  
            ]);
        }
    }
}
