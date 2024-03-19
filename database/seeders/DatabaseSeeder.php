<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Departement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


use Spatie\Permission\Models\Role;
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
        $user = User::factory()->create([
            'name' => 'superuser',
            'email' => 'root@gmail.com',
            'jabatan' => 'Direktur',
            'departement_id' => 1,
            'password' => Hash::make('admin123')
        ]);
        $role = Role::create(['name' => 'Superuser']);
        $user->assignRole($role);

        $user2 = User::factory()->create([
            'name' => 'user',
            'email' => 'irgosg@gmail.com',
            'jabatan' => 'spv',
            'departement_id' => 1,
            'password' => Hash::make('admin123')
        ]);
        $role2 = Role::create(['name' => 'user']);
        $user2->assignRole($role2);
    }
}
