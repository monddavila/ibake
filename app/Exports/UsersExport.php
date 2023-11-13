<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(User::getAllUser());
    }

    public function headings():array{

        return [
            'id',
            'firstname',
            'lastname',
            'email',
            'role_id',
            'phone',
            'address',
            'created_at',
        ];
    }
}
