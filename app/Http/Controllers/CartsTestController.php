<?php

namespace App\Http\Controllers;

use App\Models\CartsTest;
use App\Models\CartItemsTest;
use App\Models\ShopItemTest;
use Illuminate\Http\Request;

class CartsTestController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  protected $fillable = ['user_id'];

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
    $cart = new CartsTest();
    $cart->user_id = $userId;
    $cart->save();
    return $cart;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreCartsTestRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $product = ShopItemTest::findOrFail($request->input('product_id'));
    $quantity = $request->input('quantity');

    $cart = CartsTest::where('user_id', auth()->id())->first();
    $this->authorize('create-cart-item', $cart); // check if user is authorized to add a new cart item

    if (!$cart) {
      $cart = new CartsTest();
      $cart->user_id = auth()->id();
      $cart->save();
    }

    $cartItem = new CartItemsTest();
    $cartItem->cart_id = $cart->id;
    $cartItem->product_id = $product->id;
    $cartItem->quantity = $quantity;
    $cartItem->save();

    return redirect()->back()->with('success', 'Item added to cart successfully!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\CartsTest  $cartsTest
   * @return \Illuminate\Http\Response
   */
  public function show(CartsTest $cartsTest)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CartsTest  $cartsTest
   * @return \Illuminate\Http\Response
   */
  public function edit(CartsTest $cartsTest)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateCartsTestRequest  $request
   * @param  \App\Models\CartsTest  $cartsTest
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, CartsTest $cartsTest)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CartsTest  $cartsTest
   * @return \Illuminate\Http\Response
   */
  public function destroy(CartsTest $cartsTest)
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



  /**
   * Get the the cart items.
   */
}
