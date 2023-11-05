<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CakeBuilderDetailsTableSeeder extends Seeder
{
    public function run()
    {
        $cakeBuilderDetails = [
            [
                'size' => 'Small',
                'price' => 699,
                'description' => '6 Servings',
            ],
            [
                'size' => 'Medium',
                'price' => 899,
                'description' => '10 Servings',
            ],
            [
                'size' => 'Large',
                'price' => 1099,
                'description' => '14 Servings',
            ],
        ];

        $now = Carbon::now();

        // Insert the data into the 'cake_builder_details' table with timestamps
        $detailsData = array_map(function ($detail) use ($now) {
            return [
                'size' => $detail['size'],
                'price' => $detail['price'],
                'description' => $detail['description'],
                'created_at' => $now,
            ];
        }, $cakeBuilderDetails);

        DB::table('cake_builder_details')->insert($detailsData);
    }
}

