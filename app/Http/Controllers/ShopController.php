<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
  public function shop()
  {
    return view('shop.shop');
  }

  public function item()
  {
    return view('shop.item');
  }
}
