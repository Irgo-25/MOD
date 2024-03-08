<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Departement;
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
        DB::table('Departements')->insert([
            'name' => 'IT',
            'pic' => 'Wira Budi'
        ]);
        DB::table('Departements')->insert([
            'name' => 'Laminated',
            'pic' => 'Handoyo'
        ]);
        DB::table('Departements')->insert([
            'name' => 'Calender',
            'pic' => 'Paijan'
        ]);
        DB::table('users')->insert([
            'name' => 'superuser',
            'email' => 'root@gmail.com',
            'jabatan' => 'Direktur',
            'role' => 'Superuser',
            'departement_id' => 1,
            'password' => Hash::make('admin123')
        ]);
    }
}
