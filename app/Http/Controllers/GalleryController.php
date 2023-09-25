<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class GalleryController extends Controller
{
    public function gallery(Request $request)
  {
      $products = Product::where('isfeatured', 1)->get();
    
      // Fetch unique category IDs
      $productTags = Product::select('category_id')->distinct()->get();

      // Fetch category names associated with those IDs
      //$categoryNames = Category::whereIn('id', $productTags->pluck('category_id'))->pluck('name');
      $categoryNames = Category::pluck('name')->unique()->take(7);

      return view('pages.gallery')->with([
          'products' => $products,
          'productTags' => $productTags,
          'categoryNames' => $categoryNames, // Pass category names to the view
      ]);
  }

  public function portfolio(Request $request)
  {

      return view('pages.portfolio');
  }

}
