<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeRatingColumnTypeInReviewsTable extends Migration
{
    public function up()
    {
        // Alter the column type from integer to double
        DB::statement('ALTER TABLE reviews MODIFY COLUMN rating DOUBLE');
    }


    public function down()
    {
        // If you ever need to reverse this change, you can define the 'down' method.
        // However, downgrading a column type isn't straightforward and may require data conversion.
        // For simplicity, you can leave the 'down' method empty or remove it.
    }
}

