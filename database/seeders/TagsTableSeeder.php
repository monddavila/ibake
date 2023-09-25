<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'Fondant'],
            ['name' => 'Boiled Icing'],
            ['name' => 'Small'],
            ['name' => 'Big'],
            ['name' => 'Wedding'],
            ['name' => 'Birthday'],
            ['name' => 'Customized'],
            
            // Add more tags data as needed
        ];

        // Insert the data into the 'roles' table
        DB::table('tags')->insert($tags);
    }
}
