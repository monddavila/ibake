<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CreateNewFeatureStatusTable extends Migration
{
    public function up()
    {
        Schema::create('feature_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->timestamps();
        });

        // Seed the categories table
        $this->seedFeatureStatus();

    }

    /**
     * Seed the categories table.
     *
     * @return void
     */
    protected function seedFeatureStatus()
    {
        Artisan::call('db:seed', ['--class' => FeatureStatusSeeder::class]);
    }


    public function down()
    {
        Schema::dropIfExists('feature_status');
    }
}

