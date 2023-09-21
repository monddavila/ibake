<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Models\Product;
use App\Models\Category;
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
      $categories = Category::all();
      return view('admin.pages.products.products-add', compact('categories'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreProductsRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreProductsRequest $request)
  {
    //dd($request->all());

    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->image = $this->storeImage($request); // Assign the image path to the 'image' column
    $product->item_description = $request->item_description;
    $product->category_id = $request->category;
    $product->availability = $request->has('is_available');
    $product->isfeatured = $request->has('is_featured');
    $product->save();

    //dd($request->all());

     // Optionally, you can add a success message to the session
     session()->flash('message', 'Product added successfully.');

    return redirect(route('admin.viewAddProducts'));
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function show(Product $products)
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
    // Retrieve the product
    $product = Product::where('id', $id)->first();

    // Retrieve the categories
    $categories = Category::all();

    return view('admin.pages.products.products-edit', compact('product', 'categories'));
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
      Product::where('id', $id)->limit(1)->update($request->except([
        '_token',
        '_method',
        'image'
      ]));
    } else {
      Product::where('id', $id)->limit(1)->update([
        'name' => $request->name,
        'price' => $request->price,
        'item_description' => $request->item_description,
        'category' => $request->category,
        'image' => $this->storeImage($request) // Assign the image path to the 'image' colum
      ]);
    }

    return redirect(route('admin.viewProducts'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Products  $products
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    Product::destroy($request->id);
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
    $results = Product::where('name', 'like', '%' . $query . '%')
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
    //$directory = "images\products";
    $directory = 'images' . DIRECTORY_SEPARATOR . 'products';
    $newImgName = uniqid() . '-' . $request->name . '.' . $request->image->getClientOriginalExtension();
    $stored = $request->file('image')->move($directory, $newImgName);
    return $stored;
  }

  public function viewCategories()
  {
    //
    $categories = DB::table('categories')->get();

    return view('admin.pages.products.products-category')->with(
      ['products' => $categories]
    );
  }

  
}
