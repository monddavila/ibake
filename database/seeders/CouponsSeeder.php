<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponsSeeder extends Seeder
{
    public function run()
    {
        $couponsDetails = [
            [
                'code' => 'FIRSTORDER',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'expiration_date' => '2023-12-31 23:59:59',
                'usage_limit' => 100,
                'used_count' => 0,
            ],
            [
                'code' => 'HOLIDAYS',
                'discount_type' => 'percentage',
                'discount_value' => 5,
                'expiration_date' => '2023-12-31 23:59:59',
                'usage_limit' => 100,
                'used_count' => 0,
            ],
            [
                'code' => 'TIERSOFJOY',
                'discount_type' => 'fixed',
                'discount_value' => 150,
                'expiration_date' => '2023-12-31 23:59:59',
                'usage_limit' => 100,
                'used_count' => 0,
            ],
        ];

        $now = Carbon::now();

        // Insert the data into the 'coupons' table with timestamps
        $detailsData = array_map(function ($detail) use ($now) {
            return [
                'code' => $detail['code'],
                'discount_type' => $detail['discount_type'],
                'discount_value' => $detail['discount_value'],
                'expiration_date' => $detail['expiration_date'],
                'usage_limit' => $detail['usage_limit'],
                'used_count' => $detail['used_count'],
                'created_at' => $now,
            ];
        }, $couponsDetails);

        DB::table('coupons')->insert($detailsData);
    }
}

