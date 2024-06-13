<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Traits\AvatarGeneratorTrait;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use AvatarGeneratorTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::where('name', 'weCode')->first();

        $avatar = $this->generateLink('Admin');

        $users = [
            [
                'name'       => 'Admin',
                'email'      => 'admin@gmail.com',
                'role_id'    => Role::where('slug', 'developer')->pluck('id')->first(),
                'avatar'     => $avatar,
                'company_id' => $company->id,
                'password'   => Hash::make('password'),
                'created_at' => Carbon::now()
            ]
        ];

        User::insert($users);
    }
}
