<?php

namespace App\Exports;
use App\Models\CustomizeOrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerCustomRecordsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(CustomizeOrderDetail::getAllCustomerCustomRecords());
    }

    public function headings():array{

        return [
            'id',
            'user_id',
            'customize_order_id',
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
            'payment_option',
            'payment_status',
            'payment_balance',
            'payment_session_id',
            'payment_intent_id',
            'payment_intent_id_balance',
            'created_at',
            'updated_at',
            'order_date',
            'user_name',
            'type',
        ];
    }
}

