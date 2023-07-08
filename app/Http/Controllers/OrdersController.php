<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
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
    return view('checkout.checkout')->with(['user' => $user]);
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
    Orders::create([
      'user_id' => Auth::id(),
      'recipient_name' => $request->recipient_name,
      'recipient_phone' => $request->recipient_phone,
      'recipient_email' => $request->recipient_email,
      'delivery_date' => $request->delivery_date,
      'delivery_time' => $request->delivery_time,
      'delivery_address' => $address,
      'total_price' => 100,
      'payment_method' => $request->payment_method,
      'notes' => $request->order_notes,
    ]);


    return view('checkout.asd')->with(['request' => $request]);
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
}
