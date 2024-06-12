<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::all()->random();

        $users = [
            [
                'name'       => 'admin',
                'email'      => 'admin@gmail.com',
                'role_id'    => Role::where('slug', 'administrator')->pluck('id')->first(),
                'company_id' => $company->id,
                'password'   => Hash::make('password'),
                'created_at' => Carbon::now()
            ]
        ];

        User::insert($users);
    }
}
