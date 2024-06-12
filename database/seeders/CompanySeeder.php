<?php

namespace Database\Seeders;

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name'       => 'weCode',
                'logo'       => fake()->imageUrl(200,200),
                'created_at' => Carbon::now()
            ]
        ];

        Company::insert($companies);
    }
}
