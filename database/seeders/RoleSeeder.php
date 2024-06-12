<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role' => 'Administrador', 'slug' => 'administrator', 'created_at' => Carbon::now()],
            ['role' => 'Operador', 'slug' => 'operator', 'created_at' => Carbon::now()],
            ['role' => 'Motorista', 'slug' => 'driver', 'created_at' => Carbon::now()],
        ];

        Role::insert($roles);
    }
}
