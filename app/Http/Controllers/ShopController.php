<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\ShopItemTest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
  // Define the getSessionData function
  /* private function getSessionData()
  {
    $minPrice = session('minPrice', 0);
    $maxPrice = session('maxPrice', 1000);
    $orderBy = session('orderBy', 'created_at');
    $sortOrder = session('sortOrder', 'asc');

    return [$minPrice, $maxPrice, $orderBy, $sortOrder];
  } */

  /**
   * Display the shop page with items filtered by price range and sorted by the selected order.
   *
   * @param  Request  $request
   * @return \Illuminate\View\View
   */


   public function index(Request $request)
   {
       $products = Product::where('availability', 1)
       //->get();
       ->paginate(9);
       // Fetch unique category IDs
       $productTags = Product::select('category_id')->distinct()->get();
   
       // Fetch category names associated with those IDs
       $categoryNames = Category::whereIn('id', $productTags->pluck('category_id'))->pluck('name');
   
       // Calculate average product ratings
       $averageRatings = DB::table('reviews')
           ->select('product_id', DB::raw('AVG(rating) as average_rating'))
           ->groupBy('product_id')
           ->get();
   
       return view('shop.shop')->with([
           'products' => $products,
           'productTags' => $productTags,
           'categoryNames' => $categoryNames, // Pass category names to the view
           'averageRatings' => $averageRatings, // Pass average ratings to the view
       ]);
   }



  public function show($id)
  {
    // Product Tags
    $productTags = Product::where('availability', 1)->select('category_id')->distinct()->get();

    $product = Product::find($id);
    $categoryId = $product->category_id;
    $tags = $product->tags;

    // Query for related products (random 3) excluding the current product
    $relatedProducts = Product::where('category_id', $categoryId)
        ->where('id', '!=', $id) // Exclude the current product
        ->inRandomOrder()
        ->limit(3)
        ->get();
     
    // Query to retrieve reviews for the current product
    $reviews = Review::with('user')
        ->where('product_id', $id)
        //->get();
        ->paginate(3); // Paginate with 3 reviews per page

    $reviewCount = Review::where('product_id', $id)->count();

    // Query for average rating of the selected product
    $averageRating = Review::where('product_id', $id)->avg('rating');

    // Query and all product ratings and average it
    $productRatings = DB::table('reviews')
    ->select('product_id', DB::raw('AVG(rating) as average_rating'))
    ->groupBy('product_id')
    ->get();


    return view('shop.item')
      ->with([
        'productTags' => $productTags,
        'product' => Product::where('id', $id)->first(),
        'relatedProducts' => $relatedProducts,
        'reviews' => $reviews,
        'reviewCount' => $reviewCount,
        'averageRating' => $averageRating,
        'productRatings' => $productRatings,
        'tags' => $tags,
      ]);
  }
  
  
      public function filterShop(Request $request)
      {
          $products = Product::where('availability', 1)
              ->whereBetween('price', [$request->minPrice, $request->maxPrice])
              ->orderBy($request->sortBy, $request->sortOrder)
              ->get();
  
          $shopItems = view('shop.shop-item-card')->with(['products' => $products])->render();
  
          return response()->json(['shopItems' => $shopItems]);
      }

      public function tags()
      {
          // Replace '1' with the ID of the product you want to find
          $productId = 1;
          $product = Product::find($productId);
          
          $tags = $product->tags;

          dd($tags);
          
  
          return view('shop.tags', compact('tags'));
      }
  
  

}
