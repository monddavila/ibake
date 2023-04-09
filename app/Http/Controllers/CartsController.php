<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Http\Requests\StoreCartsRequest;
use App\Http\Requests\UpdateCartsRequest;
use App\Models\CartItems;
use App\Models\Products;
use Illuminate\Http\Request;

class CartsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($userId)
  {
    //
    $cart = new Carts();
    $cart->user_id = $userId;
    $cart->save();
    return $cart;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreCartsRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
    $product = Products::findOrFail($request->input('product_id'));
    $quantity = $request->input('quantity');

    $cart = Carts::where('user_id', auth()->id())->first();
    if (!auth()->check()) {
      $message = 'You need to log in to add items to the cart. Please log in or create an account.';
      return redirect()->back()->with('message', $message);
    }
    $this->authorize('create-cart-item', $cart); // check if user is authorized to add a new cart item

    if (!$cart) {
      $cart = new Carts();
      $cart->user_id = auth()->id();
      $cart->save();
    }

    $cartItem = new CartItems(); // Change CartItemsTest
    $cartItem->cart_id = $cart->id;
    $cartItem->product_id = $product->id;
    $cartItem->quantity = $quantity;
    $cartItem->save();

    return redirect()->back()->with('success', 'Item added to cart successfully!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Carts  $carts
   * @return \Illuminate\Http\Response
   */
  public function show(Carts $carts)
  {
    //
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

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Carts  $carts
   * @return \Illuminate\Http\Response
   */
  public function destroy(Carts $carts)
  {
    //
  }

  /**
   * Get the user that owns the cart.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
