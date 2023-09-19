<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Custom Cake', 'description' => 'Customized cakes for occasions'],
            ['name' => 'Wedding Cake', 'description' => 'Cakes for wedding events'],
            ['name' => 'Standard Cake', 'description' => 'Standard cakes'],
            ['name' => 'Tub Cake', 'description' => 'Small cakes in tubs'],
            ['name' => 'Cake Pop', 'description' => 'Lollipop like cakes'],
            ['name' => 'Cupcake', 'description' => 'cupcakes in dozen'],
            ['name' => 'Cookies', 'description' => 'customized cookies'],
            ['name' => 'Dessert', 'description' => 'sweets for desserts'],
            // Add more category data as needed
        ];

        // Insert the data into the 'roles' table
        DB::table('categories')->insert($categories);
    }
}
