<?php

namespace App\Exports;
use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SoldProductsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(OrderItem::getAllSoldProducts());
    }

    public function headings():array{

        return [
            'product',
            'product_id',
            'quantity',
            'price',
            'quantity_sold',
            'total_price',

            
        ];
    }
}
