<?php

namespace App\Http\Controllers;

use App\Models\ShopItemTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
  public function index()
  {
    // Set default values
    $minPrice = 0;
    $maxPrice = 1000;

    // Check if there is a GET request with min-price parameter
    if (request()->has('min-price')) {
      $minPrice = request('min-price');
    }
    // Check if there is a GET request with max-price parameter
    if (request()->has('max-price')) {
      $maxPrice = request('max-price');
    }

    $shopItems = DB::table('shop_item_tests')->get()->whereBetween('price', [$minPrice, $maxPrice]);

    $validatedData = request()->validate([
      'min-price' => 'numeric',
      'max-price' => 'numeric'
    ]);

    $minPrice = $validatedData['min-price'] ?? $minPrice;
    $maxPrice = $validatedData['max-price'] ?? $maxPrice;

    return view('shop.shop', compact('shopItems', 'minPrice', 'maxPrice'));
  }

  public function show($id)
  {
    return view('shop.item', [
      'shopItem' => ShopItemTest::where('item_id', $id)->first()
    ]);
  }
}
