<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('discount_value', 10, 2);
            $table->dateTime('expiration_date');
            $table->unsignedInteger('usage_limit')->nullable();
            $table->unsignedInteger('used_count')->default(0);
            $table->timestamps();
        });

        // Seed the coupons table
        $this->seedCouponsTableDetails();
    }

    protected function seedCouponsTableDetails()
    {
        Artisan::call('db:seed', ['--class' => CouponsSeeder::class]);
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
