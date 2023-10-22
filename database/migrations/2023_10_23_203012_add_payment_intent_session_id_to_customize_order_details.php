<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentIntentSessionIdToCustomizeOrderDetails extends Migration
{
    public function up()
    {
        Schema::table('customize_order_details', function (Blueprint $table) {
            $table->string('payment_intent_id_balance')->after('payment_intent_id')->nullable();;
            
        });
    }

    public function down()
    {
        Schema::table('customize_order_details', function (Blueprint $table) {
            $table->dropColumn('payment_intent_id_balance');
        });
    }
}



?>
