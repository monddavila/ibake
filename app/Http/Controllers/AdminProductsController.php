<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductsController extends Controller
{
  //

  function viewProductsList()
  {
    $products = DB::table('products')->get();

    return view('admin.pages.products.products-list')->with(
      ['products' => $products]
    );
  }

  function viewAddProducts()
  {
    return view('admin.pages.products.products-add');
  }
}
