<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TagsTableSeeder extends Seeder
{
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

        $now = Carbon::now();

        // Insert the data into the 'tags' table with timestamps
        $tagData = array_map(function ($tag) use ($now) {
            return [
                'name' => $tag['name'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $tags);

        DB::table('tags')->insert($tagData);
    }
}

