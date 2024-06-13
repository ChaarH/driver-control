<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory(10)->create();

        $this->call([
            CompanySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);

        User::factory(50)->create();

        $this->call(DriverSeeder::class);
    }
}
