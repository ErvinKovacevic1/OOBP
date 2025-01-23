<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RadnikFactory extends Factory
{
    protected $model = \App\Models\Radnik::class;

    public function definition(): array
    {
        return [
            'ime' => $this->faker->firstName(),
            'prezime' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefon' => $this->faker->phoneNumber(),
            'adresa' => $this->faker->address(),
            'status' => $this->faker->randomElement(['aktivan', 'neaktivan']),
        ];
    }
}
