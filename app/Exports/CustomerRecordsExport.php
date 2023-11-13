<?php

namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CustomerRecordsExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        return [
            'Custom Records' => new CustomerCustomRecordsExport(),
            'Shop Records' => new CustomerShopRecordsExport(),
            // Add more sheets if needed
        ];
    }
}

