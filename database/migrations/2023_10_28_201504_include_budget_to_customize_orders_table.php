<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class includeBudgetToCustomizeOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('customize_orders', function (Blueprint $table) {
            $table->string('budget')->nullable()->default(null)->after('cake_icing');
        });
    }

    public function down()
    {
        Schema::table('customize_orders', function (Blueprint $table) {
            $table->dropColumn([
                'budget',
            ]);
        });
    }
}


 ?>