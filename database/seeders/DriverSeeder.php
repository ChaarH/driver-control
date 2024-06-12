<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Role;
use App\Models\User;
use Database\Factories\DriverFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = User::where('role_id', Role::ROLES['driver'])->get();
//        dd($drivers);
//        dd(Role::ROLES['driver']);

        if ($drivers->isEmpty()) {
            throw new \Exception('Nenhum motorista cadastrado para que DriverSeeder seja executado!');
        }

        foreach ($drivers as $driver) {
            Driver::factory()->create([
                'user_id' => $driver->id,
                'online' => false,
                'in_run' => false
            ]);
        }
    }
}
