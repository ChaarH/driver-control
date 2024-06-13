<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Traits\AvatarGeneratorTrait;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    use AvatarGeneratorTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logo = $this->generateLink('weCode');

        $companies = [
            [
                'name'       => 'weCode',
                'logo'       => $logo,
                'created_at' => Carbon::now()
            ]
        ];

        Company::insert($companies);
    }
}
