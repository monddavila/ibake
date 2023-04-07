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
    $categories = ['Cakes', 'Cupcakes', 'Tub Cakes', 'Cookies', 'Cake Pops'];
    return [
      'name' => $this->faker->unique()->sentence(2),
      'price' => $this->faker->numberBetween(100, 1000),
      'item_description' => $this->faker->sentence(50),
      'category' => $this->faker->randomElement($categories),
      'rating' => $this->faker->numberBetween(1, 5),
      'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
      'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
    ];
  }
}
/* 
php artisan make:model CartTest -a
php artisan make:model CarItemsTest -a
php artisan make:model OrdersTest -a
php artisan make:model OrdersItemsTest -a
*/
