<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Carts;
use App\Models\Products;
use App\Models\ShopItemTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
  // Define the getSessionData function
  /* private function getSessionData()
  {
    $minPrice = session('minPrice', 0);
    $maxPrice = session('maxPrice', 1000);
    $orderBy = session('orderBy', 'created_at');
    $sortOrder = session('sortOrder', 'asc');

    return [$minPrice, $maxPrice, $orderBy, $sortOrder];
  } */

  /**
   * Display the shop page with items filtered by price range and sorted by the selected order.
   *
   * @param  Request  $request
   * @return \Illuminate\View\View
   */


  public function index(Request $request)
  {
    $products = Products::where('availability', 1)->get();
    $productTags = Products::select('category')->distinct()->get();
    return view('shop.shop')->with([
      'products' => $products,
      'productTags' => $productTags
    ]);
  }


  public function show($id)
  {
    // Product Tags
    $productTags = Products::where('availability', 1)->select('category')->distinct()->get();

    return view('shop.item')
      ->with([
        'productTags' => $productTags,
        'product' => Products::where('id', $id)->first(),
      ]);
  }

  function filterShop(Request $request)
  {

    $products = Products::where('availability', 1)
      ->whereBetween('price', [$request->minPrice, $request->maxPrice])
      ->orderBy($request->sortBy, $request->sortOrder)
      ->get();

    $shopItems = view('shop.shop-item-card')->with(['products' => $products])->render();

    return response()->json(['shopItems' => $shopItems]);
  }
}
