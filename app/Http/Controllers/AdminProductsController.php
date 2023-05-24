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

  function viewAddCategory()
  {
    return view('admin.pages.products.products-category');
  }

  function addProducts(Request $request)
  {
    Products::create([
      'name' => $request->product_name,
      'price' => $request->product_price,
      'item_description' => $request->product_description,
      'category' => $request->product_category,
    ]);

    return response()->json(['asd' => $request->all()]);
  }
}
