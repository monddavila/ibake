<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $categories = ['1', '2', '3', '4', '5', '6', '7','8'];
    return [
      'name' => $this->faker->unique()->sentence(2),
      'price' => $this->faker->numberBetween(100, 1000),
      'item_description' => $this->faker->sentence(50),
      'category' => $this->faker->randomElement($categories),
      'rating' => $this->faker->numberBetween(1, 5),
      'availability' => $this->faker->boolean(),
      'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
      'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
    ];
  }
}
