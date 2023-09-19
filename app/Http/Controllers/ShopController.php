<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
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
      $products = Product::where('availability', 1)->get();
    
      // Fetch unique category IDs
      $productTags = Product::select('category_id')->distinct()->get();

      // Fetch category names associated with those IDs
      $categoryNames = Category::whereIn('id', $productTags->pluck('category_id'))->pluck('name');

      return view('shop.shop')->with([
          'products' => $products,
          'productTags' => $productTags,
          'categoryNames' => $categoryNames, // Pass category names to the view
      ]);
  }



  public function show($id)
  {
    // Product Tags
    $productTags = Product::where('availability', 1)->select('category_id')->distinct()->get();

    

    return view('shop.item')
      ->with([
        'productTags' => $productTags,
        'product' => Product::where('id', $id)->first(),
      ]);
  }

  function filterShop(Request $request)
  {

    $products = Product::where('availability', 1)
      ->whereBetween('price', [$request->minPrice, $request->maxPrice])
      ->orderBy($request->sortBy, $request->sortOrder)
      ->get();

    $shopItems = view('shop.shop-item-card')->with(['products' => $products])->render();

    return response()->json(['shopItems' => $shopItems]);
  }
}
