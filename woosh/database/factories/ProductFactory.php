<?php

namespace Database\Factories;

use App\Models\Product;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => \ucfirst($this->faker->words(1, true)),
            'category' => $this->faker->randomElement(Product::CATEGORIES),
            'description' => $this->faker->sentence(20),
            'datetime' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}
