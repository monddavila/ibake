<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCustomizeOrderDetails extends Migration
{
    public function up()
    {
        Schema::table('customize_order_details', function (Blueprint $table) {
            // Make the order_id column nullable
            $table->unsignedBigInteger('order_id')->after('customOrder_id')->nullable();
            $table->string('payment_option')->after('payment_method');
            
            // Change the position of the payment_balance column to be after payment_status and add the nullable constraint
            $table->decimal('payment_balance', 10, 2)->after('payment_status')->nullable();
        });
    }

    public function down()
    {
        Schema::table('customize_order_details', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('payment_option');
            $table->dropColumn('payment_balance');
        });
    }
}



?>
