<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $userId = DB::table('users')->insertGetId([
                'name' => "Instruktur $i",
                'username' => "instruktur$i",
                'email' => "instruktur$i@example.com",
                'password' => Hash::make('password'),
                'role' => "instruktur",
                'status' => "active",
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('instruktur')->insert([
                'user_id' => $userId,
                'bidang_keahlian' => "Bidang Keahlian $i",
                'no_telepon' => "0812345678$i",
                'jenis_kelamin' => $i % 2 == 0 ? 'perempuan' : 'laki-laki',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
