<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Http\Requests\StoreCartItemsRequest;
use App\Http\Requests\UpdateCartItemsRequest;

class CartItemsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index($cartId, $productId, $quantity)
  {
    //
    $itemExists = CartItems::where('cart_id', $cartId)
      ->where('product_id', $productId)
      ->exists();

    $item = CartItems::where('cart_id', $cartId)
      ->where('product_id', $productId)
      ->first();

    if ($itemExists) {
      return $this->update($item, $quantity);
    } else {
      return $this->create($cartId, $productId, $quantity);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($cartId, $productId, $quantity)
  {
    //
    return CartItems::create(
      [
        'cart_id' => $cartId,
        'product_id' => $productId,
        'quantity' => $quantity,
      ]
    );
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreCartItemsRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store($cartId, $productId, $quantity)
  {
    //
    return CartItems::create([
      'cart_id' => $cartId,
      'product_id' => $productId,
      'quantity' => $quantity
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\CartItems  $cartItems
   * @return \Illuminate\Http\Response
   */
  public function show(CartItems $cartItems)
  {
    //
  }

  public function showCartWidget($cartId)
  {
    //
    $items = CartItems::where('cart_id', $cartId)->take(2)->get();
    $remaining = CartItems::count() - 2;

    return [$items, $remaining];
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CartItems  $cartItems
   * @return \Illuminate\Http\Response
   */
  public function edit(CartItems $cartItems)
  {
    //


  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateCartItemsRequest  $request
   * @param  \App\Models\CartItems  $cartItems
   * @return \Illuminate\Http\Response
   */
  public function update($item, $quantity)
  {
    //
    $newQuantity = $item->quantity + $quantity;
    $item->update(['quantity' => $newQuantity]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CartItems  $cartItems
   * @return \Illuminate\Http\Response
   */
  public function destroy($productId, $cartId)
  {
    //
    CartItems::where('cart_id', $cartId)
      ->where('product_id', $productId)
      ->delete();
    return redirect()->back();
  }
}
