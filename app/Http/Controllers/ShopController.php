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
  private function getSessionData()
  {
    $minPrice = session('minPrice', 0);
    $maxPrice = session('maxPrice', 1000);
    $orderBy = session('orderBy', 'created_at');
    $sortOrder = session('sortOrder', 'asc');

    return [$minPrice, $maxPrice, $orderBy, $sortOrder];
  }

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
      'orderBy' => session('orderBy', 'created_at'),
      'sortOrder' => session('sortOrder', 'asc')
    ]);

    // Get the price value from the session variable
    [$minPrice, $maxPrice, $orderBy, $sortOrder] = $this->getSessionData();

    // Reset Filter
    if ($request->has('view-all')) {
      session()->forget(['minPrice', 'maxPrice', 'orderBy', 'sortOrder']);
      [$minPrice, $maxPrice, $orderBy, $sortOrder] = $this->getSessionData();
      $products = DB::table('products')->get();
      return view('shop.shop', compact('products'))
        ->with([
          'minPrice' => $minPrice,
          'maxPrice' => $maxPrice,
        ]);
    }


    // Check if there is a GET request with orderby parameter
    if (request()->has('sort-order')) {
      switch (request('sort-order')) {
          /* case 'popularity':
          $orderBy = 'popularity';
          $sortOrder = 'desc';
          break; */
        case 'rating':
          $orderBy = 'rating';
          $sortOrder = 'desc';
          break;
        case 'recent':
          $orderBy = 'created_at';
          $sortOrder = 'desc';
          break;
        case 'price-asc':
          $orderBy = 'price';
          $sortOrder = 'asc';
          break;
        case 'price-desc':
          $orderBy = 'price';
          $sortOrder = 'desc';
          break;
        default:
          $orderBy = 'created_at';
          $sortOrder = 'desc';
      }
    }

    // Store the sort order value in session variable
    session([
      'orderBy' => $orderBy,
      'sortOrder' => $sortOrder,
    ]);


    // Retrieve the shop items with the selected criteria
    $products = DB::table('products')
      ->whereBetween('price', [$minPrice, $maxPrice])
      ->orderBy($orderBy, $sortOrder)
      ->get();

    // Show items in cart widget
    $userCart = new CartsController();
    $widgetProductIds = $userCart->userCartWidget();
    $cartWidgetProducts = Products::wherein('id', $widgetProductIds)->get();
    $cartItemCount = Products::wherein('id', $widgetProductIds)->count() - 2;

    // Render the shop view with the filtered and sorted shop items
    return view('shop.shop', compact('products', 'sortOrder'))
      ->with([
        'minPrice' => $minPrice,
        'maxPrice' => $maxPrice,
        'cartWidgetProducts' => $cartWidgetProducts,
        'cartItemCount' => $cartItemCount
      ]);
  }


  public function show($id)
  {
    $userCart = new CartsController();
    $widgetProductIds = $userCart->userCartWidget();
    $cartWidgetProducts = Products::wherein('id', $widgetProductIds)->get();
    $cartItemCount = Products::wherein('id', $widgetProductIds)->count() - 2;
    return view('shop.item', [
      'product' => Products::where('id', $id)->first()
    ])->with([
      'cartWidgetProducts' => $cartWidgetProducts,
      'cartItemCount' => $cartItemCount
    ]);
  }
}
