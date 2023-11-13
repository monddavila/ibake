<?php

namespace App\Exports;
use App\Models\Review;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductReviewsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Review::getAllReview());
    }

    public function headings():array{

        return [
            'id',
            'item',
            'user_name',
            'comment',
            'rating',
            'created_at',
            'updated_at',
        ];
    }
}
