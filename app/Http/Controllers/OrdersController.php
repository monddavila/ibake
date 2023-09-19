<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrderItemsController;
use App\Models\OrderItem;
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

    $order = Order::create([
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

    return redirect(route('shop'));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function show(Order $orders)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function edit(Order $orders)
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
  public function update(UpdateOrdersRequest $request, Order $orders)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Orders  $orders
   * @return \Illuminate\Http\Response
   */
  public function destroy(Order $orders)
  {
    //
  }

  /**
   * Show the orders on Dashboard homepage.
   *
   */
  public function ordersDashboard()
  {
    $orders = Order::orderBy('delivery_date')
      ->take(5)
      ->get()
      // copy 'created_at' column to 'order_date' with d M Y format (01 Jan 2023)
      ->map(function ($order) {
        $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
        return $order;
      });


    return response()->json(['orders' => $orders]);
  }

  /**
   * Show the active orders on by accessing
   * thorough the sidebar.
   *
   */
  function activeOrders()
  {
    $activeOrders = Order::where('order_status', '=', 'Pending')
      ->orWhere('order_status', '=', 'Ongoing')->get()
      ->map(function ($order) {
        $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
        return $order;
      });

    return view('admin.pages.orders.active-orders')->with([
      'activeOrders' => $activeOrders,
    ]);
  }
}
