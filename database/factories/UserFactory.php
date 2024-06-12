<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        $roles     = Role::whereIn('slug', ['operator', 'driver'])->get();
        $companies = Company::all();

        if ($roles->isEmpty() || $companies->isEmpty()) {
            throw new \Exception('Erro ao executar UserFactory!');
        }

        $random_role    = $roles->random();
        $random_company = $companies->random();

        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'role_id'           => $random_role->id,
            'company_id'        => $random_company->id,
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'remember_token'    => Str::random(10),
            'created_at'        => Carbon::now()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
