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
