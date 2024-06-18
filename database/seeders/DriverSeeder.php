<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Role;
use App\Models\User;
use Database\Factories\DriverFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = User::where('role_id', Role::ROLES['driver'])->get();

        if ($drivers->isEmpty()) {
            throw new \Exception('Nenhum motorista cadastrado para que DriverSeeder seja executado!');
        }

        $runs     = 20;
        $likes    = rand(0, $runs);
        $dislikes = $runs - $likes;

        foreach ($drivers as $driver) {
            $online = rand(0, 1);

            Driver::factory()->create([
                'user_id'   => $driver->id,
                'online'    => $online,
                'pix'       => Str::random(10),
                'car_brand' => fake()->text(50),
                'in_run'    => $online === 1 ? true : false,
                'likes'     => $likes,
                'dislikes'  => $dislikes,
            ]);
        }
    }
}
