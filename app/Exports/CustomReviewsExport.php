<?php

namespace App\Exports;
use App\Models\CustomCakeReview;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomReviewsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(CustomCakeReview::getAllCustomReview());
    }

    public function headings():array{

        return [
            'id',
            'order_id',
            'user_name',
            'comment',
            'rating',
            'created_at',
            'updated_at',
        ];
    }
}
