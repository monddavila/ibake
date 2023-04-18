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

    // Product Tags
    $productTags = Products::select('category')->distinct()->get();

    // Reset Filter
    if ($request->has('view-all')) {
      session()->forget(['minPrice', 'maxPrice', 'orderBy', 'sortOrder']);
      [$minPrice, $maxPrice, $orderBy, $sortOrder] = $this->getSessionData();
      $products = DB::table('products')->get();
      return view('shop.shop', compact('products'))
        ->with([
          'productTags' => $productTags,
          'minPrice' => $minPrice,
          'maxPrice' => $maxPrice,
        ]);
    }


    // Check if there is a GET request with
    // orderby parameter and sorts the
    // items accordingly
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

    // Display for users that are not logged in
    if (!auth()->check()) {
      return view('shop.shop', compact('products'))
        ->with([
          'productTags' => $productTags,
          'minPrice' => $minPrice,
          'maxPrice' => $maxPrice,
        ]);
    }

    // Display for users are not logged in
    // but have no cart items
    // True = user has cart items
    // False = user has no cart items
    $hasCart = Carts::where('user_id', auth()->user()->id)->exists();
    if (!$hasCart) {
      return view('shop.shop', compact('products', 'sortOrder'))
        ->with([
          'productTags' => $productTags,
          'minPrice' => $minPrice,
          'maxPrice' => $maxPrice,
          'hasCart' => $hasCart
        ]);
    }

    // Display for users are logged in
    // and have cart items
    $cart = new CartsController();
    $userCart = $cart->userCart();

    // Render the shop view with the filtered and sorted shop items
    return view('shop.shop', compact('products', 'sortOrder'))
      ->with([
        'productTags' => $productTags,
        'minPrice' => $minPrice,
        'maxPrice' => $maxPrice,
        'hasCart' => $hasCart,
        'userCart' => $userCart->take(2),
        'userCartCount' => $userCart->count()
      ]);
  }


  public function show($id)
  {
    // Product Tags
    $productTags = Products::select('category')->distinct()->get();
    // Display for users that are not logged in
    if (!auth()->check()) {
      return view('shop.item')
        ->with([
          'productTags' => $productTags,
          'product' => Products::where('id', $id)->first()
        ]);
    }

    // Display for users are not logged in
    // but have no cart items
    $hasCart = Carts::where('user_id', auth()->user()->id)->exists();
    if (!$hasCart) {
      return view('shop.item',)
        ->with([
          'productTags' => $productTags,
          'product' => Products::where('id', $id)->first(),
          'hasCart' => $hasCart
        ]);
    }

    // Display for users are logged in
    // and have cart items
    $cart = new CartsController();
    $userCart = $cart->userCart();

    return view('shop.item')
      ->with([
        'productTags' => $productTags,
        'product' => Products::where('id', $id)->first(),
        'hasCart' => $hasCart,
        'userCart' => $userCart->take(2),
        'userCartCount' => $userCart->count()
      ]);
  }
}
