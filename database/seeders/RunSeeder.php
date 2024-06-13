<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Role;
use App\Models\Run;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Provider\pt_BR\Address;

class RunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with('driver')
            ->where('role_id', Role::ROLES['driver'])
            ->get();

        if ($users->isEmpty()) {
            throw new \Exception('Nenhum motorista cadastrado para que DriverSeeder seja executado!');
        }

        foreach ($users as $user) {
            $random_number_of_runs = rand(5, 50);

            $city = fake()->city();

            for ($x = 0; $x < $random_number_of_runs; $x++) {
                Run::create([
                    'driver_id'     => $user->driver->id,
                    'company_id'    => $user->company_id,
                    'price'         => rand(15, 20),
                    'city_from'     => $city,
                    'city_to'       => $city,
                    'district_from' => fake(),
                    'district_to'   => fake(),
                    'address_from'  => fake()->streetAddress(),
                    'address_to'    => fake()->streetAddress(),
                    'created_at'    => Carbon::now(),
                    'started_at'    => Carbon::now()->subHours(rand(1,10)),
                    'ended_at'      => Carbon::now()->subHours(rand(1,3))->subMinutes(1, 59),
                ]);
            }

        }
    }
}
