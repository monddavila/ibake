<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customize_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('orderID');
            $table->integer('isSelectionOrder');
            $table->text('cakeOrderImage')->nullable();
            $table->string('cakeSize')->nullable();
            $table->string('cakeFlavor')->nullable();
            $table->string('cakeFilling')->nullable();
            $table->string('cakeIcing')->nullable();
            $table->string('cakeTopBorder')->nullable();
            $table->string('cakeBottomBorder')->nullable();
            $table->string('cakeDecoration')->nullable();
            $table->text('cakeMessage')->nullable();
            $table->text('invoice_details')->nullable();
            $table->unsignedBigInteger('cakePrice')->nullable();
            $table->integer('orderStatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customize_orders');
    }
};
