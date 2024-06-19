<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\ReasonWithdrawal;
use Illuminate\Database\Seeder;
use Mockery\Exception;

class ReasonWithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $reasons = [
                [
                    'company_id'  => $company->id,
                    'reason'      => 'Discordou do valor da corrida',
                ],
                [
                    'company_id'  => $company->id,
                    'reason'      => 'Pediu a corrida em outra empresa',
                ],
                [
                    'company_id'  => $company->id,
                    'reason'      => 'Desistiu do tempo de chegada do motorista',
                ],
                [
                    'company_id'  => $company->id,
                    'reason'      => 'Não informado',
                ],
            ];

            ReasonWithdrawal::insert($reasons);
        }

    }
}
