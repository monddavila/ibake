<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class ReviewsController extends Controller
{
    public function sendReviews(Request $request)
    {
          
        $user_id = $request->input('user_id');
        $comment = $request->input('message');
        $product_id = $request->input('product_id');

        if($request->input('rating')== null){
            $rating = 5;
        }   


        
            /**$hasOrderWithProduct = Order::where('user_id', $user_id)
            ->whereHas('orderItems', function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            })
            ->exists(); **/

            /* Query to check if the user has an order with the specific product */
            $hasOrderWithProduct = Order::where('user_id', $user_id)
            ->where('order_status', 'Completed') // Add this condition
            ->whereHas('orderItems', function ($query) use ($product_id) {
                $query->where('product_id', $product_id);
            })
            ->exists();


            if ($hasOrderWithProduct) {
                DB::table('reviews')->insert([
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'comment' => $comment,
                    'rating' => $rating,
                    'created_at' => now(),
                    'updated_at' => null,
                ]);
        
        
                return redirect()->back();
                
            } else {
               
                return redirect()->back()->with('error', 'You cannot leave a review for this product because you have not purchased or completed an order for it yet');
            }

    }
}
