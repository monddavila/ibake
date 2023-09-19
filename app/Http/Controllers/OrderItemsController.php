<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Http\Requests\StoreOrderItemsRequest;
use App\Http\Requests\UpdateOrderItemsRequest;

class OrderItemsController extends Controller
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
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreOrderItemsRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store($orderId, $productId, $price, $quantity)
  {
    //
    OrderItem::create([
      'order_id' => $orderId,
      'product_id' => $productId,
      'price' => $price,
      'quantity' => $quantity,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\OrderItems  $orderItems
   * @return \Illuminate\Http\Response
   */
  public function show(OrderItem $orderItems)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\OrderItems  $orderItems
   * @return \Illuminate\Http\Response
   */
  public function edit(OrderItem $orderItems)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateOrderItemsRequest  $request
   * @param  \App\Models\OrderItems  $orderItems
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateOrderItemsRequest $request, OrderItem $orderItems)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\OrderItems  $orderItems
   * @return \Illuminate\Http\Response
   */
  public function destroy(OrderItem $orderItems)
  {
    //
  }
}
