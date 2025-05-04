<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->randomDigit(),
            'quantity_sold' => $this->faker->randomDigit(),
            'purchase_value' => $this->faker->randomFloat(2,10,30),
            'sale_value' => $this->faker->randomFloat(2,10,30),
            'purchase_date' => $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
            'sale_date' => $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
            'due_date' => $this->faker->date(),
            'ativo' => $this->faker->randomDigit(),
            'product_code' => Product::all()->random()->code,
            'manufacturer_id' => Manufacturer::all()->random()->id,
            'admin_id' => Admin::all()->random()->id,
        ];
    }
}
