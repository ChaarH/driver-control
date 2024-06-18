<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            $random_number_rows = [5, 10, 15, 20];
            $count_array_rows   = count($random_number_rows) -1;
            $random             = rand(0, $count_array_rows);

            $settings = [
                [
                    'company_id'  => $company->id,
                    'setting'     => 'Preço padrão da corrida',
                    'slug'        => 'run_price',
                    'description' => 'Valor padrão que será atribuído à todas as corridas',
                    'value'       => rand(12,20)
                ],
                [
                    'company_id'  => $company->id,
                    'setting'     => 'Número de linhas exibidas nas tabelas',
                    'slug'        => 'num_rows',
                    'description' => 'Quantidade de linhas que serão exibidas em todas as tabelas do sistema',
                    'value'       => $random_number_rows[$random]
                ],
            ];

            Settings::insert($settings);
        }

    }
}
