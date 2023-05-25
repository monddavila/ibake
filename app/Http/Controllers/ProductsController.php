<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
  /**
   * Display a listing of the products.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    $products = DB::table('products')->get();

    return view('admin.pages.products.products-list')->with(
      ['products' => $products]
    );
  }

  /**
   * Show the form for adding/creating a new product.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    return view('admin.pages.products.products-add');
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
    Products::create([
      'name' => $request->product_name,
      'price' => $request->product_price,
      'item_description' => $request->product_description,
      'category' => $request->product_category,
      'image_path' => $this->storeImage($request),
    ]);

    return redirect(route('admin.viewAddProducts'));
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
    ]);
  }

  public function search(Request $request)
  {

    $query = $request->input('query');
    $sortBy = $request->input('sortBy');
    $sortDirection = $request->input('sortDirection');

    // Perform the necessary database query based on the search query and sorting options
    // Example query for item search and sorting:
    $results = Products::where('name', 'like', '%' . $query . '%')
      ->orderBy($sortBy, $sortDirection)
      ->get();

    $html = view('admin.pages.products.products-list-table')->with(
      ['products' => $results]
    )->render();

    return response()->json(['html' => $html]);
  }

  private function storeImage($request)
  {
    $newImageName = uniqid() . '-' . $request->product_name . '.' . $request->img->getClientOriginalExtension();
    return
      $request->img->storeAs('images/products', $newImageName);
  }
}
