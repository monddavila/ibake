<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Products;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersDataExport implements FromView,ShouldAutoSize
{
    use Exportable;

    private $users;

    public function __construct() {
        $this->users = User::with('role')
        ->paginate(10);
    }

    public function view() : View
    {
        return view('admin.pages.users',[
            'users' => $this->users
        ]);
    }
}