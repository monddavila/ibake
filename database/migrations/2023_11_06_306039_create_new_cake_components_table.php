<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CreateNewCakeComponentsTable extends Migration
{
    public function up()
    {
        Schema::create('cake_components', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('layer')->nullable();
            $table->string('name')->nullable();
            $table->string('color')->nullable();
            $table->boolean('availability')->default(1)->nullable();
            $table->timestamps();
        });

        // Seed the categories table
        $this->seedCakeComponents();

    }

    /**
     * Seed the categories table.
     *
     * @return void
     */
    protected function seedCakeComponents()
    {
        Artisan::call('db:seed', ['--class' => CakeComponentsTableSeeder::class]);
    }


    public function down()
    {
        Schema::dropIfExists('cake_components');
    }
}

