<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class CreateDeliveryFeesTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_fees', function (Blueprint $table) {
            $table->id();
            $table->string('province');
            $table->string('town');
            $table->decimal('fee', 10, 2);
            $table->timestamps();
        });

        // Seed the delivery_fees table
        $this->seedDeliveryFeesDetails();
    }

    protected function seedDeliveryFeesDetails()
    {
        Artisan::call('db:seed', ['--class' => DeliveryFeesSeeder::class]);
    }

    public function down()
    {
        Schema::dropIfExists('delivery_fees');
    }
}
