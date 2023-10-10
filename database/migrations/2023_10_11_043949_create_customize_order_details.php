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
    Schema::create('customize_order_details', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('customOrder_id');
      $table->string('recipient_name');
      $table->unsignedBigInteger('recipient_phone');
      $table->string('recipient_email');
      $table->string('shipping_method');
      $table->date('delivery_date');
      $table->time('delivery_time');
      $table->string('delivery_address');
      $table->text('notes')->nullable();
      $table->string('order_status')->default('Pending');
      $table->unsignedBigInteger('total_price');
      $table->string('payment_method');
      $table->string('payment_status')->default('Unpaid');
      $table->string('payment_session_id')->nullable();
      $table->string('payment_intent_id')->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('customOrder_id')->references('id')->on('customize_orders')->onDelete('cascade');
      
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('orders');
  }
};
