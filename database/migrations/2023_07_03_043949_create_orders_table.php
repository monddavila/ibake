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
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->string('recipient_name');
      $table->unsignedBigInteger('recipient_phone');
      $table->string('recipient_email');
      $table->date('delivery_date');
      $table->time('delivery_time');
      $table->string('delivery_address');
      $table->string('order_status')->default('Pending');
      $table->unsignedBigInteger('total_price');
      $table->string('payment_method');
      $table->string('payment_status')->default('Not yet paid');
      $table->text('notes')->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
