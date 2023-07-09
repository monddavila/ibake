<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrderItemsController;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
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
  public function create()
  {
    //
    $user = Auth::user();
    $cartItems = (new CartsController())->userCart();
    $totalPrice = 0;
    foreach ($cartItems as $cartItem) {
      # code...
      $totalPrice += ($cartItem->price * $cartItem->quantity);
    }
    /*     $userCart = (new CartsController())->userCart();
    order_id
    product_id
    price
    quantity

 
        'cart_items.cart_id',
        'cart_items.product_id',
        'cart_items.quantity',
        'products.name',
        'products.price',
        'products.image' */

    return view('checkout.checkout')->with([
      'user' => $user,
      'cartItems' => $cartItems,
      'totalPrice' => $totalPrice
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreOrdersRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreOrdersRequest $request)
  {
    //
    $validated = $request->validated();

    $address = $request->street_address . ', ' . $request->town . ',' . $request->province . ',' . $request->postcode;
    $cartItems = (new CartsController())->userCart();

    $totalPrice = 0;
    foreach ($cartItems as $cartItem) {
      # code...
      $totalPrice += ($cartItem->price * $cartItem->quantity);
    }

    $order = Orders::create([
      'user_id' => Auth::id(),
      'recipient_name' => $request->recipient_name,
      'recipient_phone' => $request->recipient_phone,
      'recipient_email' => $request->recipient_email,
      'delivery_date' => $request->delivery_date,
      'delivery_time' => $request->delivery_time,
      'delivery_address' => $address,
      'total_price' => $totalPrice,
      'payment_method' => $request->payment_method,
      'notes' => $request->order_notes,
    ]);

    $orderItem = new OrderItemsController();
    $orderId = $order->id;
    foreach ($cartItems as $cartItem) {
      $productId = $cartItem->product_id;
      $price = $cartItem->price;
      $quantity = $cartItem->quantity;
      $orderItem->store($orderId, $productId, $price, $quantity);
    }

    return view('checkout.asd')->with([
      'request' => $order,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function show(Orders $orders)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function edit(Orders $orders)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateOrdersRequest  $request
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateOrdersRequest $request, Orders $orders)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function destroy(Orders $orders)
  {
    //
  }

  public function ordersDashboard()
  {
    $orders = Orders::get();
    $orders = Orders::orderBy('delivery_date')
      ->take(5)
      ->get()
      // copy 'created_at' column to 'order_date' with Y-m-d format 
      ->map(function ($order) {
        $order->order_date = $order->created_at->format('Y-m-d');
        return $order;
      });;

    return response()->json(['orders' => $orders]);
  }
}
