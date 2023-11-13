<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePriceColumnCakeBuilderTable extends Migration
{
    public function up()
    {
        Schema::table('cake_builder_details', function (Blueprint $table) {
            // Change the data type of the 'price' column to BIGINT
            $table->bigInteger('price')->change();
        });
    }

    public function down()
    {
        Schema::table('cake_builder_details', function (Blueprint $table) {
            // If you need to rollback, you can change the data type back to DECIMAL(8, 2)
            $table->decimal('price', 8, 2)->change();
        });
    }
}

