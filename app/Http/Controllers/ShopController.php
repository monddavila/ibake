<?php

namespace App\Http\Controllers;

use App\Models\ShopItemTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
  /**
   * Display the shop page with items filtered by price range and sorted by the selected order.
   *
   * @param  Request  $request
   * @return \Illuminate\View\View
   */
  public function index(Request $request)
  {
    // Store the minimum and maximum price values in session variables
    session([
      'minPrice' => $request->input('min-price', session('minPrice', 0)),
      'maxPrice' => $request->input('max-price', session('maxPrice', 1000)),
    ]);

    // Get the price value from the session variable
    $minPrice = session('minPrice', 0);
    $maxPrice = session('maxPrice', 1000);

    if ($request->has('view-all')) {
      session()->forget(['minPrice', 'maxPrice']);
      $minPrice = session('minPrice', 0);
      $maxPrice = session('maxPrice', 1000);
      $shopItems = DB::table('shop_item_tests')
        ->whereBetween('price', [$minPrice, $maxPrice])
        ->get();
      return view('shop.shop', compact('shopItems'))
        ->with([
          'minPrice' => $minPrice,
          'maxPrice' => $maxPrice,
        ]);
    }


    // Check if there is a GET request with orderby parameter
    $orderBy = '';
    $sortOrder = session('sortOrder', '');
    $result = '';
    if (request()->has('sort-order')) {
      switch (request('sort-order')) {
        case 'popularity':
          $orderBy = 'popularity';
          $sortOrder = 'desc';
          $result = 'Most Popular';
          break;
        case 'rating':
          $orderBy = 'rating';
          $sortOrder = 'desc';
          $result = 'Highest Rated';
          break;
        case 'recent':
          $orderBy = 'created_at';
          $sortOrder = 'desc';
          $result = 'Most Recent';
          break;
        case 'price-asc':
          $orderBy = 'price';
          $sortOrder = 'asc';
          $result = 'Price Low to High';
          break;
        case 'price-desc':
          $orderBy = 'price';
          $sortOrder = 'desc';
          $result = 'Price High to Low';
          break;
        default:
          $orderBy = '';
          $sortOrder = '';
          $result = '';
      }
    }

    // Store the sort order value in session variable
    session(['sortOrder' => $sortOrder]);

    // Retrieve the shop items with the selected criteria
    if ($orderBy !== '') {
      $shopItems = DB::table('shop_item_tests')
        ->whereBetween('price', [$minPrice, $maxPrice])
        ->orderBy($orderBy, $sortOrder)
        ->get();
    } else {
      $shopItems = DB::table('shop_item_tests')
        ->whereBetween('price', [$minPrice, $maxPrice])
        ->get();
    }



    // Render the shop view with the filtered and sorted shop items
    return view('shop.shop', compact('shopItems', 'sortOrder'))
      ->with([
        'minPrice' => $minPrice,
        'maxPrice' => $maxPrice,
      ]);
  }


  public function show($id)
  {
    return view('shop.item', [
      'shopItem' => ShopItemTest::where('item_id', $id)->first()
    ]);
  }
}
