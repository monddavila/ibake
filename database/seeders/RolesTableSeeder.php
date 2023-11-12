<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin', 'description' => 'Administrator with full access'],
            ['name' => 'Customer', 'description' => 'End-user of the system, selecting or buying a product'],
            ['name' => 'Manager', 'description' => 'Responsible for business operations'],
            ['name' => 'Owner', 'description' => 'Oversee the business operations'],
            ['name' => 'Baker', 'description' => 'Bakers can view orders'],
            ['name' => 'Designer', 'description' => 'Designers can view orders'],
            // Add more role data as needed
        ];

        // Insert the data into the 'roles' table
        DB::table('roles')->insert($roles);
    }
}
