<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeliveryFeesSeeder extends Seeder
{
    public function run()
    {
        $towns = [
            "Alfonso Castañeda",
            "Ambaguio",
            "Aritao",
            "Bambang",
            "Bayombong",
            "Diadi",
            "Dupax del Norte",
            "Dupax del Sur",
            "Kasibu",
            "Kayapa",
            "Quezon",
            "Santa Fe",
            "Solano",
            "Villaverde",
        ];

        $province = 'Nueva Vizcaya';
        $fee = 200;
        $now = Carbon::now();

        // Insert the data into the 'delivery_fees' table with timestamps
        $deliveryFeesData = array_map(function ($town) use ($province, $fee, $now) {
            return [
                'province' => $province,
                'town' => $town,
                'fee' => $fee,
                'created_at' => $now,
            ];
        }, $towns);

        DB::table('delivery_fees')->insert($deliveryFeesData);
    }
}
