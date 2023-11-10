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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;


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

       $products = Product::paginate(12);

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
    $userReview=null;
    $reviewExists=null;
    $cartItems=null;
    $user = auth()->user();
    if($user){
    $user_id = $user->id;

    /* Query to check if the user has already a review with the specific product */
    $reviewExists = Review::where('product_id', $id)
    ->where('user_id', $user_id)
    ->with('user')
    ->exists();

    $userReview = Review::with('user')
    ->where('product_id', $id) 
    ->where('user_id', $user_id) 
    ->get();

    if (Cart::where('user_id', auth()->user()->id)->exists()) {

        $cartItems = $this->userCartItems($id);
    }

    }

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
        'reviewExists' => $reviewExists,
        'userReview' => $userReview,
        'cartItems' => $cartItems,
      ]);
  }

  public function userCartItems($id)
  {
    // Get the user's cart Id
    $cartId = Cart::where('user_id', auth()->user()->id)->first()->id;
    // Get product name, price, and quantity of the user's cart
    $userCart = CartItem::where('cart_id', $cartId)
      ->where('product_id', $id)
      ->join('products', 'cart_items.product_id', '=', 'products.id')
      ->select(
        'cart_items.cart_id',
        'cart_items.product_id',
        'cart_items.quantity',
        'products.name',
        'products.price',
        'products.available_qty',
        'products.image'
      )
      ->first();

    return $userCart;
  }
  
  
  public function filterShop(Request $request)
  {

    //dd($request->minPrice);
      $products = Product::whereBetween('price', [$request->minPrice, $request->maxPrice])
          ->orderBy($request->sortBy, $request->sortOrder)
          ->paginate(12);
     
  
      // Fetch unique category IDs
      $productTags = Product::select('category_id')->distinct()->get();
  
      // Fetch category names associated with those IDs
      $categoryNames = Category::whereIn('id', $productTags->pluck('category_id'))->pluck('name');
  
      // Calculate average product ratings
      $averageRatings = DB::table('reviews')
      ->select('product_id', DB::raw('AVG(rating) as average_rating'))
      ->groupBy('product_id')
      ->orderBy('average_rating', 'desc')
      ->get();

  
      $shopItems = view('shop.shop-item-card')->with([
          'products' => $products,
          'productTags' => $productTags,
          'categoryNames' => $categoryNames,
          'averageRatings' => $averageRatings,
      ])->render();
  
      return response()->json(['shopItems' => $shopItems]);
  }


      public function filterCategories(Request $request)
   {

      $category = $request->input('category');

      if ($category === 'All') {
      $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
      ->select('products.*')
      ->orderBy('products.rating', 'desc')  // Order by the rating column in descending order
      ->paginate(12);


      session(['filter_type' => ['type' => '2', 'data' => $category]]);

      }else{
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*')
        ->where('categories.name', $category)
        ->orderBy('products.rating', 'desc')  // Order by the rating column in descending order
        ->paginate(12);

        
      session(['filter_type' => ['type' => '1', 'data' => $category]]);
      }

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

   

   public function searchProducts(Request $request)
  {
      $query = $request->input('query');
    

      // Initial query without any filters
      $productsQuery = Product::join('categories', 'products.category_id', '=', 'categories.id')
          ->select('products.*');

      // Apply search filter if query is present
      if ($request->has('query') && !is_null($request->input('query'))) {
          $productsQuery->where(function ($queryBuilder) use ($query) {
              $queryBuilder->where('products.name', 'like', "%$query%")
                  ->orWhere('categories.name', 'like', "%$query%");
          });

          session(['filter_type' => ['type' => '3', 'data' => $query]]);
      }
      


      // Apply additional filters or ordering as needed
      $products = $productsQuery
          ->orderBy('products.rating', 'desc')  // Order by the rating column in descending order
          ->paginate(12);

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
          'query' => $query,
      ]);
  }

  public function sortProducts(Request $request)
   {

    
      $sort = $request->input('sort-order');
      
      // Retrieve the entire 'filter_type' array from the session
      $filterType = session('filter_type');
      // Access specific values from the 'filter_type' array
      $type = $filterType['type'];
      $data = $filterType['data'];


      if($type === '1'){
        //dd('1');
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*')
        ->where('categories.name', $data);
    
        if ($request->input('sort-order') == 'created_at') {
          $products->orderBy('products.created_at', 'desc');
      } elseif ($request->input('sort-order') == 'rating') {
          $products->orderBy('products.rating', 'desc');
      } elseif ($request->input('sort-order') == 'availability') {
          $products->orderBy('products.availability', 'desc');
      } elseif ($request->input('sort-order') == 'price-asc') {
          $products->orderBy('products.price', 'asc');
      } elseif ($request->input('sort-order') == 'price-desc') {
          $products->orderBy('products.price', 'desc');
      }
      
      $products = $products->paginate(12);
    
      }elseif($type === '2'){

        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*');

        if ($request->input('sort-order') == 'created_at') {
          $products->orderBy('products.created_at', 'desc');
      } elseif ($request->input('sort-order') == 'rating') {
          $products->orderBy('products.rating', 'desc');
      } elseif ($request->input('sort-order') == 'availability') {
          $products->orderBy('products.availability', 'desc');
      } elseif ($request->input('sort-order') == 'price-asc') {
          $products->orderBy('products.price', 'asc');
      } elseif ($request->input('sort-order') == 'price-desc') {
          $products->orderBy('products.price', 'desc');
      }
      
      $products = $products->paginate(12);

    }elseif($type === '3'){

        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
          ->select('products.*')
          ->where(function ($queryBuilder) use ($data) {
            $queryBuilder->where('products.name', 'like', "%$data%")
                ->orWhere('categories.name', 'like', "%$data%");
        });
        if ($request->input('sort-order') == 'created_at') {
            $products->orderBy('products.created_at', 'desc');
        } elseif ($request->input('sort-order') == 'rating') {
            $products->orderBy('products.rating', 'desc');
        } elseif ($request->input('sort-order') == 'availability') {
            $products->orderBy('products.availability', 'desc');
        } elseif ($request->input('sort-order') == 'price-asc') {
            $products->orderBy('products.price', 'asc');
        } elseif ($request->input('sort-order') == 'price-desc') {
            $products->orderBy('products.price', 'desc');
        }

        $products = $products->paginate(12);
    }else{
      $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*');

        if ($request->input('sort-order') == 'created_at') {
          $products->orderBy('products.created_at', 'desc');
      } elseif ($request->input('sort-order') == 'rating') {
          $products->orderBy('products.rating', 'desc');
      } elseif ($request->input('sort-order') == 'availability') {
          $products->orderBy('products.availability', 'desc');
      } elseif ($request->input('sort-order') == 'price-asc') {
          $products->orderBy('products.price', 'asc');
      } elseif ($request->input('sort-order') == 'price-desc') {
          $products->orderBy('products.price', 'desc');
      }
      
      $products = $products->paginate(12);
    }
    

      

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

  
  

}
