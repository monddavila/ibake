<?php

namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShopSalesExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Order::getAllShopSales());
    }

    public function headings():array{

        return [
            'id',
            'customer_name',
            'order_id',
            'order_status',
            'payment_status',
            'payment_method',
            'order_amount',
            'order_date',
        ];
    }
}

