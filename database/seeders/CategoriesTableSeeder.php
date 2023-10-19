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
            ['name' => 'Custom Cake', 'description' => 'Customized cakes for occasions', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wedding Cake', 'description' => 'Cakes for wedding events', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Standard Cake', 'description' => 'Standard cakes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tub Cake', 'description' => 'Small cakes in tubs', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cake Pop', 'description' => 'Lollipop like cakes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cupcake', 'description' => 'cupcakes in dozen', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cookies', 'description' => 'customized cookies', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dessert', 'description' => 'sweets for desserts', 'created_at' => now(), 'updated_at' => now()],
            // Add more category data as needed
        ];

        // Insert the data into the 'roles' table
        DB::table('categories')->insert($categories);
    }
}
