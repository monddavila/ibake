<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartsRequest;
use App\Http\Requests\UpdateCartsRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Http\Controllers\CartItemsController as CartItemsCtrl;
use App\Models\CartItem;
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
    if (!Cart::where('user_id', auth()->user()->id)->exists()) {
      return view('shop.shopping-cart')->with([
        'cartItems' => false,
        'totalPrice' => 0
      ]);
    } else {
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
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($userId)
  {
    //
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
      $cartItem->image = $request->product_image;

      // retrieve current session data
      $sessionCart = session()->get('notAuthCart', []);

      // Check if item is in cart
      if (!empty($sessionCart)) {
        foreach ($sessionCart as $item) {
          if ($item->productId == $cartItem->productId) {
            $item->quantity += $cartItem->quantity;
            // Return cart widget partial with updated data
            return $this->userCartWidget();
          }
        }
      }

      // Store cart item in session
      $sessionCart[] = $cartItem;
      session(['notAuthCart' => $sessionCart]);

      return $this->userCartWidget();
    }

    // Get the user's cart, or create a new one if it doesn't exist
    $cart = Cart::where('user_id', auth()->user()->id)->first();
    if (!$cart) {
      $userId = auth()->user()->id;
      $cart = Cart::create(['user_id' => $userId]);
    }

    // Get the product and quantity from the request
    $cartId = $cart->id;
    $productId = Product::findOrFail($request->product_id)->id;
    $quantity = $request->qty;

    $cartItem = new CartItemsCtrl();
    $cartItem->store($cartId, $productId, $quantity);

    return $this->userCartWidget();
  }


  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Cart  $carts
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    //

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Cart  $carts
   * @return \Illuminate\Http\Response
   */
  public function edit(Cart $carts)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateCartsRequest  $request
   * @param  \App\Models\Cart  $carts
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCartsRequest $request, Cart $carts)
  {
    //
  }

  /**.
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Cart  $carts
   * @return \Illuminate\Http\Response
   */
  public function destroy(Cart $carts)
  {
    //
  }

  public function userCart()
  {
    // Get the user's cart Id
    $cartId = Cart::where('user_id', auth()->user()->id)->first()->id;
    // Get product name, price, and quantity of the user's cart
    $userCart = CartItem::where('cart_id', $cartId)
      ->join('products', 'cart_items.product_id', '=', 'products.id')
      ->select(
        'cart_items.cart_id',
        'cart_items.product_id',
        'cart_items.quantity',
        'products.name',
        'products.price',
        'products.image'
      )
      ->get();

    return $userCart;
  }

  public function userCartWidget()
  {
    if (Auth::check()) {
      $cartItems = $this->userCart();
      $cartWidget = view('shop.cart-widget')
        ->with([
          'userCart' => $cartItems->take(2),
          'cartItemCount' => count($cartItems)
        ])
        ->render();
      return response()->json(['cartWidget' => $cartWidget]);
    } else {
      // retrieve current session data
      $sessionCart = session()->get('notAuthCart', []);

      // Check if item is in cart
      if (!empty($sessionCart)) {
        // Get first two items
        $userCart = count($sessionCart) > 2 ? array_slice($sessionCart, 0, 2) : $sessionCart;
        $cartWidget = view('shop.cart-widget')
          ->with([
            'userCart' => $userCart,
            'cartItemCount' => count($sessionCart)
          ])
          ->render();

        // Return cart widget partial with updated data
        return response()->json([
          'cartWidget' => $cartWidget
        ]);
      }
    }
  }




  /**
   * Implement datbase relationship
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
