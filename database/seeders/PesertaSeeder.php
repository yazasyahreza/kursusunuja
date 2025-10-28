<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $userId = DB::table('users')->insertGetId([
                'name' => "Peserta $i",
                'username' => "peserta$i",
                'email' => "peserta$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'peserta',
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('peserta')->insert([
                'user_id' => $userId,
                'no_telepon' => "0812345678$i",
                'alamat' => "Alamat Peserta $i",
                'jenis_kelamin' => $i % 2 == 0 ? 'perempuan' : 'laki-laki',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
