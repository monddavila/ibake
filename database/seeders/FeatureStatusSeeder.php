<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeatureStatusSeeder extends Seeder
{
    public function run()
    {
        $featureStatus= [
            [
                'name' => 'cake_builder',
                'status' => 1,
            ],
        ];

        $now = Carbon::now();

        // Insert the data into the 'cake_builder_details' table with timestamps
        $featureStatusData = array_map(function ($detail) use ($now) {
            return [
                'name' => $detail['name'],
                'status' => $detail['status'],
                'created_at' => $now,
            ];
        }, $featureStatus);

        DB::table('feature_status')->insert($featureStatusData);
    }
}

