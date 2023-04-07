<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Cart Items
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cart_items_tests', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('cart_id');
      $table->unsignedBigInteger('product_id');
      $table->integer('quantity');
      $table->timestamps();

      $table->foreign('cart_id')->references('id')->on('carts_tests')->onDelete('cascade');
      $table->foreign('product_id')->references('id')->on('shop_item_tests')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cart_items_tests');
  }
};
