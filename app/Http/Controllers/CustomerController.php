<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\CustomizeOrderDetail;
use App\Models\CustomizeOrder;


class CustomerController extends Controller
{
    public function index(){
        $orders = DB::table('customize_orders')
                    ->select('*')
                    ->where('customize_orders.userID', Auth::user()->id)
                    ->orderBy('orderStatus', 'asc')
                    ->orderBy('created_at', 'desc')
                    ->get();
        // dd($orders);
        return view('customer.chome', compact('orders'));
    }

    function customerActiveOrders()
  {
    $userId = Auth::user()->id; // Get the ID of the currently logged-in user.

    $activeOrders = Order::where('user_id', $userId) // Filter by user ID.
        ->where('order_status', 'Pending')
        ->get()
        ->map(function ($order) {
            $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
            return $order;
        });

    $activeCustomOrders = CustomizeOrderDetail::where('user_id', $userId) // Filter by user ID.
        ->where('order_status', 'Pending')
        ->get()
        ->map(function ($order) {
            $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
            return $order;
      });

      $orderDetails = CustomizeOrderDetail::where('order_status', 'Pending')
        ->where('user_id', $userId) // Filter by the user's ID
        ->with('customizeOrder') // Eager load the related CustomizeOrder
        ->get();

    return view('customer.pages.customer-active-order')->with([
      'activeOrders' => $activeOrders, 
      'activeCustomOrders' => $activeCustomOrders,
      '$orderDetails' => $orderDetails,
    ]);
  }

  function customerCompletedOrders()
  {
    $userId = Auth::user()->id; // Get the ID of the currently logged-in user.

    $completedOrders = Order::where('user_id', $userId)
        ->where(function ($query) {
            $query->where('order_status', 'Completed')
                ->orWhere('order_status', 'Refunded')
                ->orWhere('order_status', 'Cancelled');
        })
        ->get()
        ->map(function ($order) {
            $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
            return $order;
        });

    $completedCustomOrders = CustomizeOrderDetail::where('user_id', $userId)
        ->where(function ($query) {
            $query->where('order_status', 'Completed')
                ->orWhere('order_status', 'Refunded')
                ->orWhere('order_status', 'Cancelled');
        })
        ->get()
        ->map(function ($order) {
            $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
            return $order;
      });

      $orderDetails = CustomizeOrderDetail::where('user_id', $userId)
        ->where(function ($query) {
            $query->where('order_status', 'Completed')
                  ->orWhere('order_status', 'Refunded')
                  ->orWhere('order_status', 'Cancelled');
      })
        ->with('customizeOrder') // Eager load the related CustomizeOrder
        ->get();

    return view('customer.pages.customer-order-history')->with([
      'completedOrders' => $completedOrders, 
      'completedCustomOrders' => $completedCustomOrders,
      '$orderDetails' => $orderDetails,
    ]);
  }


}
