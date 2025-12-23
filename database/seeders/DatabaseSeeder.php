<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('123123123'),
                'nama' => 'Admin Santoso',
                'role' => 'admin',
            ],
            [
                'username' => 'siswa',
                'password' => Hash::make('123123123'),
                'nama' => 'Siswa Santoso',
                'role' => 'siswa',
            ],
            [
                'username' => 'kepalaSekolah',
                'password' => Hash::make('123123123'),
                'nama' => 'Kepala Santoso',
                'role' => 'kepala-sekolah',
            ],
            [
                'username' => 'sriutomo',
                'password' => Hash::make('123123123'),
                'nama' => 'Sri Utomo',
                'role' => 'tata-usaha',
            ],
            [
                'username' => 'purwanta',
                'password' => Hash::make('123123123'),
                'nama' => 'Purwanta',
                'role' => 'waka-kesiswaan',
            ],
            [
                'username' => 'odearstiko',
                'password' => Hash::make('123123123'),
                'nama' => 'Ode Arstiko',
                'role' => 'siswa',
            ],
        ]);
    }
}
