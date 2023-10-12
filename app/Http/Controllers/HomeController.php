<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\CustomizeOrderDetail;
use App\Models\CustomizeOrder;

class HomeController extends Controller
{

  public function home()
  {
    return view("home");
  }

  function contact()
  {
    return view('pages.contact');
  }

  function about()
  {
    return view('pages.about');
  }

  function chef()
  {
    return view('pages.chef');
  }

  function customize()
  {
    return view('pages.customize');
  }

  /**function gallery()
  {
    return view('pages.gallery');
  }

  function portfolio()
  {
    return view('pages.portfolio');
  }
  */
  function blog()
  {
    return view('pages.blog');
  }

  function faqs()
  {
    return view('pages.faqs');
  }

  function track()
  {

    return view('pages.track');
  }

  function trackOrderId(Request $request)
  {
    $orderId = $request->order_id;

    session(['track_orderId' => $orderId]);

    return $this->trackOrders();
  }


  function trackOrders(){
    
    $orderId = session('track_orderId');
    $error = ''; // Initialize the error variable


    $orderDetails = Order::where('order_id', $orderId)->get();
    /**$customizeOrderDetails = DB::table('customize_order_details')
      ->join('customize_orders', 'customize_order_details.customOrder_id', '=', 'customize_orders.id')
      ->where('customize_orders.orderID', $orderId)
      ->select('customize_order_details.*')
      ->get(); **/

      $customizeOrderDetails = CustomizeOrderDetail::join('customize_orders', 'customize_order_details.customOrder_id', '=', 'customize_orders.id')
      ->where('customize_orders.orderID', $orderId)
      ->select('customize_order_details.*')
      ->get();
  


      if ($orderDetails->isEmpty() && $customizeOrderDetails->isEmpty()) {
        $error = 'No order details found.';
      }

        return view('pages.track')->with([
          'orderId' => $orderId,
          'error' => $error, 
          'orderDetails' => $orderDetails, 
          'customizeOrderDetails' => $customizeOrderDetails,
        ]);
  }





  public function redirect()
  {
    if (!Auth::check()) {
      return view('home');
    }

    return Auth::user()->role_id == '1' ? view('admin.home') : view('home');

    /* $usertype = Auth::user()->role_id;
    // Admin Account
    if ($usertype == '1') {
      return view('admin.home');
    }

    // Other Accounts - will include guest, manager and bakers separately
    else {
      return view('home');
    } */
  }
}
