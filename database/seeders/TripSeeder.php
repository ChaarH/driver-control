<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Driver;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Provider\pt_BR\Address;

class TripSeeder extends Seeder
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

        $operators = User::where('role_id', Role::ROLES['operator'])
            ->pluck('id');

        foreach ($users as $user) {
//            $random_number_of_runs = rand(5, 50);
            $random_number_of_runs = 20;

            $random_array_operators = rand(0, $operators->count()-1);

            $city = City::all()->random();

            for ($x = 0; $x < $random_number_of_runs; $x++) {

                $address_from = fake()->streetAddress();
                $address_to   = fake()->streetAddress();

                Trip::create([
                    'created_by_id' => $operators[$random_array_operators],
                    'driver_id'     => $user->driver->id,
                    'company_id'    => $user->company_id,
                    'price'         => rand(15, 25),
                    'city_id_from'  => $city->id,
                    'city_id_to'    => $city->id,
                    'district_from' => 'Bairro 1',
                    'district_to'   => 'Bairro 2',
                    'address_from'  => $address_from,
                    'address_to'    => $address_to,
                    'created_at'    => Carbon::now(),
                    'started_at'    => Carbon::now()
                        ->subHours(rand(1,10))
                        ->format('Y-m-d H:i:s'),
                    'ended_at'      => Carbon::now()
                        ->subHours(rand(1,3))
                        ->subMinutes(1, 59)
                        ->format('Y-m-d H:i:s'),
                ]);
            }

        }
    }
}
