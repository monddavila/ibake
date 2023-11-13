<?php

namespace App\Exports;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Product::getAllProduct());
    }

    public function headings():array{

        return [
            'id',
            'name',
            'price',
            'item_description',
            'category_id',
            'rating',
            'available_qty',
            'availability',
            'isFeatured',
            'created_at',
        ];
    }
}
