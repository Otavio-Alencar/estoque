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
            'purchase_value' => $this->faker->randomDigit(),
            'sale_value' => $this->faker->randomDigit(),
            'purchase_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'ativo' => $this->faker->randomDigit(),
            'product_code' => Product::all()->random()->code,
            'manufacturer_id' => Manufacturer::all()->random()->id,
            'admin_id' => Admin::all()->random()->id,
        ];
    }
}
