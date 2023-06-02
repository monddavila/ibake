<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    $product = [
      'name' => 'Item 1',
      'price' => 123,
      'item_description' => 'Item 1 Description',
      'category' => 'Item Category',
    ];

    foreach ($product as $key => $value) {
      Products::create($value);
    }
  }
}
