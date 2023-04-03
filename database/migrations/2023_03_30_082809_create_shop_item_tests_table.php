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
    Schema::create('shop_item_tests', function (Blueprint $table) {
      $table->id('item_id');
      $table->string('name')->unique();
      $table->integer('price');
      $table->text('item_description');
      $table->text('category');
      $table->float('rating')->default(0);
      $table->timestamps(); // Adds created_at and updated_at columns
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('shop_item_tests');
  }
};
