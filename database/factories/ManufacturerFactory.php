<?php

namespace Database\Factories;

use App\Models\Representative;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory>
 */
class ManufacturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $representative = null;
        if (Representative::all()->count() > 0) {
            $representative = Representative::all()->random()->id;
        }

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'representative_id' => $representative
        ];
    }
}
