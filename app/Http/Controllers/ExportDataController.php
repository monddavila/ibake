<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\ProductsExport;
use App\Models\User;
use Excel;

class ExportDataController extends Controller 
{
    public function exportUsersData() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportProductsData() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}