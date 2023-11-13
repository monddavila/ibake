<?php

namespace App\Exports;
use App\Models\CustomizeOrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomSalesExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(CustomizeOrderDetail::getAllCustomSales());
    }

    public function headings():array{

        return [
            'id',
            'customer_name',
            'order_id',
            'order_status',
            'payment_status',
            'payment_method',
            'payment_option',
            'order_amount',
            'payment_balance',
            'order_date',
        ];
    }
}

