<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $cities = [
                [
                    'name'                            => 'São Lourenço',
                    'company_id'                      => $company->id,
                    'trip_price'                      => rand(10,20),
                    'increase_time_start'             => '18:00',
                    'increase_time_end'               => '06:00',
                    'trip_price_increased_after_time' => rand(10,20) + rand(5,10),
                    'default'                         => true,
                    'created_at'                      => Carbon::now()
                ],
                [
                    'name'                            => 'Carmo de Minas',
                    'company_id'                      => $company->id,
                    'trip_price'                      => rand(10,20),
                    'increase_time_start'             => '18:00',
                    'increase_time_end'               => '06:00',
                    'trip_price_increased_after_time' => rand(10,20) + rand(5,10),
                    'default'                         => false,
                    'created_at'                      => Carbon::now()
                ],
                [
                    'name'                            => 'Soledade de Minas',
                    'company_id'                      => $company->id,
                    'trip_price'                      => rand(10,20),
                    'increase_time_start'             => '18:00',
                    'increase_time_end'               => '06:00',
                    'trip_price_increased_after_time' => rand(10,20) + rand(5,10),
                    'default'                         => false,
                    'created_at'                      => Carbon::now()
                ]
            ];

            City::insert($cities);
        }
    }
}
