<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartsRequest;
use App\Http\Requests\UpdateCartsRequest;
use App\Models\Carts;
use App\Models\Products;
use App\Http\Controllers\CartItemsController as CartItemsCtrl;
use App\Models\CartItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class CartsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index(Request $request)
  {
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($userId)
  {
    //
    return Carts::create([
      'user_id' => $userId,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreCartsRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Check if user is logged in, if not redirect back with an error message
    if (!Auth::check()) {
      // Make new cart item object and add cart data
      $cartItem = new stdClass();
      $cartItem->quantity = $request->qty;
      $cartItem->productId = $request->product_id;
      $cartItem->name = $request->product_name;
      $cartItem->price = $request->product_price;

      // retrieve current session data
      $userCart = session()->get('notAuthCart', []);

      // Check if item is in cart
      foreach ($userCart as $item) {
        if ($item->productId == $cartItem->productId) {
          // Item already exists, return error response
          $item->quantity += $cartItem->quantity;

          // Return cart widget partial with data
          $cartWidget = view('shop.cart-widget')->with(['userCart' => $userCart])->render();
          return response()->json([
            'cartWidget' => $cartWidget,
            'userCart' => $userCart
          ]);
        }
      }

      // Store cart item in session
      $userCart[] = $cartItem;
      session(['notAuthCart' => $userCart]);

      $cartWidget = view('shop.cart-widget', $userCart)->with(['userCart' => $userCart])->render();

      return response()->json([
        'cartWidget' => $cartWidget,
        'userCart' => $userCart
      ]);
      // $message = 'You need to log in to add items to the cart. Please log in or create an account.';
      // return redirect()->back()->with('message', $message);
    }

    // Get the user's cart, or create a new one if it doesn't exist
    $cart = Carts::where('user_id', auth()->user()->id)->first();
    if (!$cart) {
      $userId = auth()->user()->id;
      $cart = $this->create($userId);
    }

    // Get the product and quantity from the request
    $cartId = $cart->id;
    $productId = Products::findOrFail($request->input('product_id'))->id;
    $quantity = intval($request->input('quantity'));

    $cartItem = new CartItemsCtrl();
    $cartItem->index($cartId, $productId, $quantity);

    return redirect()->back()->with('message', 'Item added to cart successfully!');
  }


  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Carts  $carts
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    //
    if (!Carts::where('user_id', auth()->user()->id)->exists()) {
      return view('shop.shopping-cart')->with([
        'cartItems' => false
      ]);
    }

    $cartItems = $this->userCart();
    $totalPrice = 0;
    foreach ($cartItems as $cartItem) {
      # code...
      $totalPrice += ($cartItem->price * $cartItem->quantity);
    }
    return view('shop.shopping-cart')->with([
      'cartItems' => $cartItems,
      'totalPrice' => $totalPrice
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Carts  $carts
   * @return \Illuminate\Http\Response
   */
  public function edit(Carts $carts)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateCartsRequest  $request
   * @param  \App\Models\Carts  $carts
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCartsRequest $request, Carts $carts)
  {
    //
  }

  /**.
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Carts  $carts
   * @return \Illuminate\Http\Response
   */
  public function destroy(Carts $carts)
  {
    //
  }

  public function userCart()
  {
    // Get the user's cart Id
    $cartId = Carts::where('user_id', auth()->user()->id)->first()->id;
    // Get product name, price, and quantity of the user's cart
    $userCart = CartItems::where('cart_id', $cartId)
      ->join('products', 'cart_items.product_id', '=', 'products.id')
      ->select(
        'cart_items.cart_id',
        'cart_items.product_id',
        'cart_items.quantity',
        'products.name',
        'products.price'
      )
      ->get();

    return $userCart;
  }



  /**
   * Implement datbase relationship
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
