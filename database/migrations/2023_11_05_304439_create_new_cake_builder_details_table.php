<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CreateNewCakeBuilderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('cake_builder_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('size')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Seed the categories table
        $this->seedCakeBuilderDetails();

    }

    /**
     * Seed the categories table.
     *
     * @return void
     */
    protected function seedCakeBuilderDetails()
    {
        Artisan::call('db:seed', ['--class' => CakeBuilderDetailsTableSeeder::class]);
    }


    public function down()
    {
        Schema::dropIfExists('cake_builder_details');
    }
}

