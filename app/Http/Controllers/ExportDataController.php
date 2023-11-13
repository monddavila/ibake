<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Exports\ProductsExport;
use App\Exports\ProductReviewsExport;
use App\Exports\CustomReviewsExport;
use App\Exports\CustomerShopRecordsExport;
use App\Exports\CustomerCustomRecordsExport;
use App\Exports\CustomerRecordsExport;
use App\Exports\ShopOrdersExport;
use App\Exports\CustomOrdersExport;
use App\Exports\SalesExport;
use App\Exports\SoldProductsExport;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
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

    public function exportProductReviews() 
    {
        return Excel::download(new ProductReviewsExport, 'product-reviews.xlsx');
    }

    public function exportCustomReviews() 
    {
        return Excel::download(new CustomReviewsExport, 'custom-order-reviews.xlsx');
    }

    public function exportCustomerRecords() 
    {
        return Excel::download(new CustomerRecordsExport, 'customer_records.xlsx');
    }

    public function exportShopRecords() 
    {
        return Excel::download(new ShopOrdersExport, 'shop_orders.xlsx');
    }

    public function exportCustomRecords() 
    {
        return Excel::download(new CustomOrdersExport, 'custom_orders.xlsx');
    }

    public function exportSalesRecords() 
    {
        return Excel::download(new SalesExport, 'sales_record.xlsx');
    }

    public function exportSoldProducts() 
    {
        return Excel::download(new SoldProductsExport, 'sold_products.xlsx');
    }

    
}