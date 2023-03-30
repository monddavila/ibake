<?php

namespace App\Http\Controllers;

use App\Models\ShopItemTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
  public function index()
  {
    $shopItems = DB::table('shop_item_tests')->get();

    return view('shop.shop', compact('shopItems'));
  }

  public function show($id)
  {
    return view('shop.item', [
      'shopItem' => ShopItemTest::where('item_id', $id)->first()
    ]);
  }
}
