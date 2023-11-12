<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Order;
use App\Models\CustomizeOrderDetail;
use App\Models\CustomizeOrder;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\CustomCakeReview;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;


class DashboardController extends Controller
{

  public function adminIndex(){

    $orders = Order::with('user')
    ->where('order_status', '!=', 'Completed')
    ->where('order_status', '!=', 'Cancelled')
    ->orderBy('created_at', 'desc')
    ->orderBy('delivery_date', 'desc')
    ->get();

    $totalInventoryValue = Product::sum(\DB::raw('price * available_qty'));

    $shopPaymentsReceived = Order::where('payment_status', 'Fully Paid')->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $customPaymentsReceived = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $customPaymentsReceivedHalf = CustomizeOrderDetail::where('payment_status', 'Partially Paid')->where('order_status', '!=', 'Cancelled')->sum('payment_balance');

    $paymentsReceived = $shopPaymentsReceived + $customPaymentsReceived + $customPaymentsReceivedHalf ;

    $totalSales = $paymentsReceived + $customPaymentsReceivedHalf;


    $shopEwallets = Order::where('payment_status', 'Fully Paid')->where('payment_method', 'wallet')->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $shopCard = Order::where('payment_status', 'Fully Paid')->where('payment_method', 'card')->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $shopBank = Order::where('payment_status', 'Fully Paid')->where('payment_method', 'bank')->where('order_status', '!=', 'Cancelled')->sum('total_price');

    $test = $customPaymentsReceived;
    //dd($test); //34931
    $tes2 = $customPaymentsReceived+$customPaymentsReceivedHalf;
    //dd($tes2); //39416
    $tes2_1 = $customPaymentsReceivedHalf;
    //dd($tes2_1); //4485

    $customEwallets = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('payment_method', 'wallet')->whereIn('payment_option', ['Full', 'Half-online'])->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $customCard = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('payment_method', 'card')->whereIn('payment_option', ['Full', 'Half-online'])->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $customBank = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('payment_method', 'bank')->whereIn('payment_option', ['Full', 'Half-online'])->where('order_status', '!=', 'Cancelled')->sum('total_price');

    $customFullCodEwallet = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('payment_option', 'Half-cod')->where('payment_method', 'wallet')->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $customFullCodCard = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('payment_option', 'Half-cod')->where('payment_method', 'card')->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $customFullCodBank = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('payment_option', 'Half-cod')->where('payment_method', 'bank')->where('order_status', '!=', 'Cancelled')->sum('total_price');
    
    $_customFullCodEwallet = $customFullCodEwallet/2;
    $_customFullCodCard  = $customFullCodCard/2;
    $_customFullCodBank = $customFullCodBank/2;

    $test3 = $customEwallets+$customFullCodEwallet;
    //dd($test3); //34931



    $customHalfEwallets = CustomizeOrderDetail::where('payment_status', 'Partially Paid')->whereIn('payment_option', ['Half-cod', 'Half-online'])->where('payment_method', 'wallet')->where('order_status', '!=', 'Cancelled')->sum('payment_balance');
    $customHalfCard = CustomizeOrderDetail::where('payment_status', 'Partially Paid')->whereIn('payment_option', ['Half-cod', 'Half-online'])->where('payment_method', 'card')->where('order_status', '!=', 'Cancelled')->sum('payment_balance');
    $customHalfBank = CustomizeOrderDetail::where('payment_status', 'Partially Paid')->whereIn('payment_option', ['Half-cod', 'Half-online'])->where('payment_method', 'bank')->where('order_status', '!=', 'Cancelled')->sum('payment_balance');
    
    $customHalfCash = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('payment_option', 'Half-cod')->where('order_status', '!=', 'Cancelled')->sum('total_price');

    $_customHalfCash = $customHalfCash/2;

    $test4 = $customHalfEwallets+$customCard+$customHalfCard+$customHalfBank;
    //dd($test4); //5034.5


    $totalEwallets = $shopEwallets + $customEwallets + $customHalfEwallets+ $_customFullCodEwallet;
    $totalCards = $shopCard + $customCard + $customHalfCard+$_customFullCodCard;
    $totalBank = $shopBank + $customBank  + $customHalfBank+$_customFullCodBank;
    $totalCash = $_customHalfCash;
    


    $sellingProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(price) as total_price'))
    ->groupBy('product_id')
    ->orderBy('total_quantity', 'desc')
    ->with('product')
    ->take(10)
    ->get();

    $reviews = Review::with('user', 'product')
    ->orderBy('created_at', 'desc')
    ->orderBy('rating', 'desc')
    ->take(5)
    ->get();

    $customReviews = CustomCakeReview::with('user')
    ->orderBy('created_at', 'desc')
    ->orderBy('rating', 'desc')
    ->take(5)
    ->get();

    $RegisteredUsers = User::count();
    $RegisteredCustomers = User::where('role_id', '2')->count();
    $products = Product::count();
    $categories = Category::count();
    $tags = Tag::count();
    $reviewCount = Review::count();
    $customReviewCount = CustomCakeReview::count();
    $totalReviewCount = $reviewCount + $customReviewCount;
    

    $orderPending = Order::where('order_status', 'Pending')->count();
    $orderProcessing = Order::where('order_status', 'Processing')->count();
    $orderReady = Order::where('order_status', 'On Delivery')->count();
    $orderCompleted = Order::where('order_status', 'Completed')->count();
    $orderCancelled = Order::where('order_status', 'Cancelled')->count();
    
    $customOrderPending = CustomizeOrderDetail::where('order_status', 'Pending')->count();
    $customOrderProcessing = CustomizeOrderDetail::where('order_status', 'Processing')->count();
    $customOrderReady = CustomizeOrderDetail::where('order_status', 'On Delivery')->count();
    $customOrderCompleted = CustomizeOrderDetail::where('order_status', 'Completed')->count();
    $customOrderCancelled = CustomizeOrderDetail::where('order_status', 'Cancelled')->count();

    $customOrderRequests = CustomizeOrder::where('orderStatus', '1')->count();
    $pendingOrders = $orderPending + $customOrderPending;
    $processingOrders = $orderProcessing + $customOrderProcessing;
    $readyOrders = $orderReady + $customOrderReady;
    $completedOrders = $orderCompleted + $customOrderCompleted;
    $cancelledOrders = $orderCancelled + $customOrderCancelled;

    $dynamicData = [
      $totalEwallets,
      $totalCards,
      $totalBank,
      $totalCash
  ];
  


    $data = [
      
      'totalInventoryValue' => $totalInventoryValue,
      'paymentsReceived' => $paymentsReceived,
      'customPaymentsReceivedHalf' => $customPaymentsReceivedHalf,
      'totalSales' => $totalSales, 
      'orders' => $orders,
      'customOrderRequests' => $customOrderRequests,
      'pendingOrders' => $pendingOrders,
      'processingOrders' => $processingOrders,
      'readyOrders' => $readyOrders,
      'completedOrders' => $completedOrders,
      'cancelledOrders' => $cancelledOrders,
      'sellingProducts' => $sellingProducts,
      'reviews' => $reviews,
      'customReviews' => $customReviews,
      'RegisteredUsers' => $RegisteredUsers,
      'RegisteredCustomers' => $RegisteredCustomers,
      'products' => $products,
      'categories' => $categories,
      'tags' => $tags,
      'totalReviewCount' => $totalReviewCount,
      'totalEwallets' => $totalEwallets,
      'totalCards' => $totalCards,
      'totalBank' => $totalBank,
      'totalCash' => $totalCash,
      'dynamicData' => $dynamicData,
    ];
   


    return view('admin.home', $data);

  }
      /**
   * Show the orders on Dashboard homepage.
   *
   */
  public function ordersDashboard()
{
    $orders = Order::with('user')
        ->where('order_status', '!=', 'Completed')
        ->where('order_status', '!=', 'Cancelled')
        ->orderBy('created_at', 'desc')
        ->orderBy('delivery_date', 'desc')
        ->take(5)
        ->get()
        ->map(function ($order) {
            $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
            $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
            $order->name = $order->user->firstname . ' ' . $order->user->lastname;
            $order->type = 'Shop Order';
            return $order;
        });

    $customOrderDetails = CustomizeOrderDetail::with('user')
        ->where('order_status', '!=', 'Completed')
        ->where('order_status', '!=', 'Cancelled')
        ->orderBy('created_at', 'desc')
        ->orderBy('delivery_date', 'desc')
        ->take(5)
        ->get()
        ->map(function ($order) {
            $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
            $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
            $order->name = $order->user->firstname . ' ' . $order->user->lastname;
            $order->type = 'Custom Order';
            return $order;
        });

    $allOrders = $orders->union($customOrderDetails)->all();

    return response()->json(['orders' => $allOrders]);
}






}
