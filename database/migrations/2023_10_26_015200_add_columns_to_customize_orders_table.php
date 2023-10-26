<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCustomizeOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('customize_orders', function (Blueprint $table) {
            $table->string('cake_size')->nullable()->default(null)->after('orderStatus');
            $table->string('cake_flavor')->nullable()->default(null)->after('cake_size');
            $table->string('cake_icing')->nullable()->default(null)->after('cake_flavor');
            $table->string('celebrant_name')->nullable()->default(null)->after('cake_icing');
            $table->date('celebrant_birthday')->nullable()->default(null)->after('celebrant_name');
            $table->string('shipping_method')->nullable()->default(null)->after('celebrant_birthday');
            $table->date('delivery_date')->nullable()->default(null)->after('shipping_method');
            $table->time('delivery_time')->nullable()->default(null)->after('delivery_date');
            $table->string('address')->nullable()->default(null)->after('delivery_time');
        });
    }

    public function down()
    {
        Schema::table('customize_orders', function (Blueprint $table) {
            $table->dropColumn([
                'cake_size',
                'cake_flavor',
                'cake_icing',
                'celebrant_name',
                'celebrant_birthday',
                'shipping_method',
                'delivery_date',
                'delivery_time',
                'address',
            ]);
        });
    }
}

 ?>