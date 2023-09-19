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
          $table->unsignedBigInteger('category_id'); // Foreign key column
          $table->float('rating')->default(0);
          $table->boolean('availability')->default(false);
          $table->boolean('isfeatured')->default(false);
          $table->timestamps();

          // Define the foreign key constraint
          $table->foreign('category_id')->references('id')->on('categories');
      });
  }

  public function down()
  {
      Schema::dropIfExists('products');
  }
};
