<?php

namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShopOrdersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Order::getAllShopOrders());
    }

    public function headings():array{

        return [
            'id',
            'customer_name',
            'order_id',
            'recipient_name',
            'recipient_phone',
            'recipient_email',
            'shipping_method',
            'delivery_date',
            'delivery_time',
            'delivery_address',
            'notes',
            'order_status',
            'total_price',
            'payment_method',
            'payment_status',
            'created_at',
        ];
    }
}

