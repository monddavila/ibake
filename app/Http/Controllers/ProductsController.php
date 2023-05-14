<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
  public function create(Request $request)
  {
    //
    Products::create([
      'name' => $request->product_name,
      'price' => $request->product_price,
      'item_description' => $request->product_description,
      'category' => $request->product_category,
    ]);

    return;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function show(Products $products)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function edit(Products $products)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Products $products)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    Products::destroy($request->id);
    $successMsg =
      '<div class="alert alert-success" role="alert">Item successfully deleted!</div>';
    $failedMsg =
      '<div class="alert alert-danger" role="alert">Something went wrong!</div>';
    return response()->json([
      'successMsg' => $successMsg,
      'failedMsg' => $failedMsg,
      'asd' => $request->all(),
      'asd' => $request->id
    ]);
  }
}
