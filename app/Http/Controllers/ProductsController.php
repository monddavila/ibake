<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
   * @param  \App\Http\Requests\StoreProductsRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreProductsRequest $request)
  {
    $product = new Products();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->item_description = $request->item_description;
    $product->category = $request->category;
    $product->image = $this->storeImage($request); // Assign the image path to the 'image' column
    $product->save();

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
  public function edit($id)
  {
    //
    $product = Products::where('id', $id)->first();
    return view('admin.pages.products.products-edit')->with(['product' => $product]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
    if (!$request->image) {
      Products::where('id', $id)->limit(1)->update($request->except([
        '_token',
        '_method',
        'image'
      ]));
    } else {
      Products::where('id', $id)->limit(1)->update([
        'name' => $request->name,
        'price' => $request->price,
        'item_description' => $request->item_description,
        'category' => $request->category,
        'image' => $this->storeImage($request) // Assign the image path to the 'image' colum
      ]);
    }

    return redirect(route(
      'admin.viewProducts'
    ));
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

  public function getImage(Request $request)
  {
    $imgPath = asset($request->imgPath);
    return response()->json(['imgPath' => $imgPath]);
  }

  private function storeImage($request)
  {
    $directory = "images\products";
    $newImgName = uniqid() . '-' . $request->name . '.' . $request->image->getClientOriginalExtension();
    $stored = $request->file('image')->move($directory, $newImgName);
    return $stored;
  }
}
