<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CakeComponentsTableSeeder extends Seeder
{
    public function run()
    {
        $CakeComponentsDetails = [
            [
                'layer' => 'Flavor',
                'name' => 'Moist Chocolate',
                'color' => '#C38154',
            ],
            [
                'layer' => 'Flavor',
                'name' => 'Carrot Walnut',
                'color' => '#FF9B50',
            ],
            [
                'layer' => 'Flavor',
                'name' => 'Ube',
                'color' => '#D988B9',
            ],
            [
                'layer' => 'Flavor',
                'name' => 'Yema',
                'color' => '#FFDBAA',
            ],
            [
                'layer' => 'Flavor',
                'name' => 'Red Velvet',
                'color' => '#E76161',
            ],
            [
                'layer' => 'Filling',
                'name' => 'Chocolate Buttercream',
                'color' => '#E2C799',
            ],
            [
                'layer' => 'Filling',
                'name' => 'Ganache',
                'color' => '#65451F',
            ],
            [
                'layer' => 'Filling',
                'name' => 'Cream Cheese',
                'color' => '#FFEECC',
            ],
            [
                'layer' => 'Filling',
                'name' => 'Ube',
                'color' => '#7A316F',
            ],
            [
                'layer' => 'Filling',
                'name' => 'Vanilla',
                'color' => '#FAF3F0',
            ],
            [
                'layer' => 'Filling',
                'name' => 'White Chocolate',
                'color' => '#EADBC8',
            ],
            [
                'layer' => 'Filling',
                'name' => 'Yema',
                'color' => '#F5F0BB',
            ],
            [
                'layer' => 'Filling',
                'name' => 'Cheese',
                'color' => '#F4CE14',
            ],
            [
                'layer' => 'Icing',
                'name' => 'Red',
                'color' => '#B22222',
            ],
            [
                'layer' => 'Icing',
                'name' => 'Light Blue',
                'color' => '#87CEEB',
            ],
            [
                'layer' => 'Icing',
                'name' => 'Lavender',
                'color' => '#E6E6FA',
            ],
            [
                'layer' => 'Icing',
                'name' => 'Peach',
                'color' => '#FFDAB9',
            ],
            [
                'layer' => 'Icing',
                'name' => 'Lemon Yellow',
                'color' => '#FFFF00',
            ],
            [
                'layer' => 'Icing',
                'name' => 'Teal',
                'color' => '#00FFFF',
            ],
            [
                'layer' => 'Icing',
                'name' => 'Orange',
                'color' => '#FFA500',
            ],
            [
                'layer' => 'topborder',
                'name' => 'Light Red',
                'color' => '#CD5C5C',
            ],
            [
                'layer' => 'topborder',
                'name' => 'Light Pink',
                'color' => '#FFB6C1',
            ],
            [
                'layer' => 'topborder',
                'name' => 'Orange',
                'color' => '#FF6F61',
            ],
            [
                'layer' => 'topborder',
                'name' => 'Purple',
                'color' => '#800080',
            ],
            [
                'layer' => 'topborder',
                'name' => 'Brown',
                'color' => '#A52A2A',
            ],
            [
                'layer' => 'topborder',
                'name' => 'Sky Blue',
                'color' => '#00BFFF',
            ],
            [
                'layer' => 'topborder',
                'name' => 'Blue',
                'color' => '#0000FF',
            ],
            [
                'layer' => 'topborder',
                'name' => 'Cream',
                'color' => '#FAEBD7',
            ],
            [
                'layer' => 'bottomborder',
                'name' => 'Light Red',
                'color' => '#CD5C5C',
            ],
            [
                'layer' => 'bottomborder',
                'name' => 'Light Pink',
                'color' => '#FFB6C1',
            ],
            [
                'layer' => 'bottomborder',
                'name' => 'Orange',
                'color' => '#FF6F61',
            ],
            [
                'layer' => 'bottomborder',
                'name' => 'Purple',
                'color' => '#800080',
            ],
            [
                'layer' => 'bottomborder',
                'name' => 'Brown',
                'color' => '#A52A2A',
            ],
            [
                'layer' => 'bottomborder',
                'name' => 'Sky Blue',
                'color' => '#00BFFF',
            ],
            [
                'layer' => 'bottomborder',
                'name' => 'Blue',
                'color' => '#0000FF',
            ],
            [
                'layer' => 'bottomborder',
                'name' => 'Cream',
                'color' => '#FAEBD7',
            ],
            [
                'layer' => 'decoration',
                'name' => 'Blue',
                'color' => '#1E90FF',
            ],
            [
                'layer' => 'decoration',
                'name' => 'Cream',
                'color' => '#F5DEB3',
            ],
            [
                'layer' => 'decoration',
                'name' => 'Yellow',
                'color' => '#FFFF00',
            ],
            [
                'layer' => 'decoration',
                'name' => 'Pink',
                'color' => '#FFC0CB',
            ],
            [
                'layer' => 'decoration',
                'name' => 'Red',
                'color' => '#FA8072',
            ],
            [
                'layer' => 'decoration',
                'name' => 'Orange',
                'color' => '#FF6347',
            ],
            [
                'layer' => 'decoration',
                'name' => 'Purple',
                'color' => '#9400D3',
            ],
            // Add more data as needed
        ];
        

        $now = Carbon::now();

        // Insert the data into the 'cake_builder_details' table with timestamps
        $detailsData = array_map(function ($detail) use ($now) {
            return [
                'layer' => $detail['layer'],
                'name' => $detail['name'],
                'color' => $detail['color'],
                'created_at' => $now,
            ];
        }, $CakeComponentsDetails);

        DB::table('cake_components')->insert($detailsData);
    }
}

