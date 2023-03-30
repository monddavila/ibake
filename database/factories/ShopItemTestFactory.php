<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShopItemTest>
 */
class ShopItemTestFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'name' => $this->faker->unique()->sentence(3),
      'price' => $this->faker->numberBetween(100, 1000),
      'item_description' => $this->faker->sentence(50),
      'category' => $this->faker->realText(10)
    ];
  }
}
