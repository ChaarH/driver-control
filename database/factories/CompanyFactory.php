<?php

namespace Database\Factories;

use App\Traits\AvatarGeneratorTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Provider\pt_BR\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    use AvatarGeneratorTrait;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company_name = fake()->company();

        $logo = $this->generateLink($company_name);

        return [
            'name'       => $company_name,
            'logo'       => $logo,
            'created_at' => Carbon::now(),
            'address'    => fake()->address(),
            'city'       => fake()->city(),
            'cep'        => fake()->postcode(),
            'phone_1'    => fake()->phoneNumber(),
            'phone_2'    => fake()->phoneNumber(),
        ];
    }
}
