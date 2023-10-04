<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Review;
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
    $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name')
        ->paginate(10);

    return view('admin.pages.products.products-list', ['products' => $products]);
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
      $tags = Tag::all(); // Retrieve all tags from the database

      return view('admin.pages.products.products-add', compact('categories', 'tags'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreProductsRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreProductsRequest $request)
  {
    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->image = $this->storeImage($request); // Assign the image path to the 'image' column
    $product->item_description = $request->item_description;
    $product->category_id = $request->category;
    $product->availability = $request->has('is_available');
    $product->isfeatured = $request->has('is_featured');
    $product->save();

    $selectedTagIds = $request->input('tags');
    // Get the current timestamp
    $currentTimestamp = now();
    // Use sync to attach tags with additional data
    $product->tags()->sync($selectedTagIds, [
        'created_at' => $currentTimestamp,
        'updated_at' => $currentTimestamp,
    ]);

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
    // Retrieve the product with its category information
    $product = Product::with('category', 'tags')->where('id', $id)->first();

    // Retrieve the categories
    $categories = Category::all();

    // Retrieve all available tags
    $tags = Tag::all();

    return view('admin.pages.products.products-edit', compact('product', 'categories', 'tags'));
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
    $product = Product::find($id);

    if (!$product) {
        return redirect()->route('admin.viewProducts')->with('error', 'Product not found.');
    }

    // Update product details
    $product->name = $request->name;
    // Check if the 'price' field is provided in the request
    if ($request->has('price')) {
      $product->price = $request->price;
    }
    $product->item_description = $request->item_description;
    $product->category_id = $request->category_id;
    
    if ($request->has('image')) {
        $product->image = $this->storeImage($request);
    }

    // Update is_available and is_featured based on checkbox values
    $product->availability = $request->has('is_available') ? 1 : 0;
    $product->isfeatured = $request->has('is_featured') ? 1 : 0;

    $product->save();

    // Update product tags
    $selectedTagIds = $request->input('tags', []); // Get selected tag IDs or an empty array if none selected
    $product->tags()->sync($selectedTagIds);

    return redirect()->route('admin.viewProducts')->with('success', 'Product updated successfully.');
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
    $categories = DB::table('categories')->paginate(8);

    return view('admin.pages.products.products-category')->with(
      ['categories' => $categories]
    );
  }

  public function addCategories(Request $request)
  {

    $request->validate([
      'name' => 'required|string|max:50|unique:categories',
      'description' => 'required|string|max:100',
    ]);

    $currentTimestamp = now();

    $category = new Category();
    $category->name = $request->name;
    $category->description = $request->description;
    $category->created_at = $currentTimestamp;
    $category->updated_at = $currentTimestamp;

    $category->save();
  

    // Optionally, you can add a success message to the session
    session()->flash('message-1', 'Category added successfully.');

    return redirect(route('admin.viewCategories'));
  }

  public function deleteCategories($id)
  {
    // Find the user by ID
    $category = Category::findOrFail($id);

    // Delete the user
    $category->delete();

    // Optionally, you can add a success message to the session
    session()->flash('message-2', 'Category deleted successfully.');

    // Redirect to the user list or any other desired page
    return redirect()->route('admin.viewCategories');
  }

  public function updateCategories(Request $request)
  {
    $request->validate([
        'name' => 'required|string|max:50',
        'description' => 'required|string|max:100',
    ]);

    $category = Category::findOrFail($request->id);
    $category->name = $request->name;
    $category->description = $request->description;
    $category->save();

    // Optionally, you can add a success message to the session
    session()->flash('message-3', 'Category updated successfully.');

    return redirect()->route('admin.viewCategories');
  }

  public function viewReviews()
{
  
    // Fetch all products for the dropdown
    $products = Product::all();
    $reviews = Review::all();
   

    return view('admin.pages.products.reviews', ['products' => $products, 'reviews' => $reviews]);
}

public function getReviews(Request $request)
{

    $productId = $request->input('productId');

    // Check if productId is empty or zero
    if (empty($productId) || $productId == 0) {
        // Handle the case where productId is zero or blank, e.g., display an error message.
        return redirect()->route('viewReview')->with('error', 'Please select a valid product.');
    }

    $products = Product::all();
    // Fetch reviews for the selected product
    $product = Product::findOrFail($productId);
    $reviews = $product->reviews;


    // Return the reviews in a blade view
    return view('admin.pages.products.reviews', ['reviews' => $reviews, 'products' => $products]);
}



  
}
