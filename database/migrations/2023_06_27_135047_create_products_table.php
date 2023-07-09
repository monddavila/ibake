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
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->unsignedBigInteger('price');
      $table->string('image')->nullable();
      $table->text('item_description');
      $table->text('category');
      $table->float('rating')->default(0);
      $table->boolean('availability')->default(false);
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
    Schema::dropIfExists('products');
  }
};
