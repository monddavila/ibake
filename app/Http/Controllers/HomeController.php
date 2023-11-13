<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use App\Models\CustomizeOrderDetail;
use App\Models\CustomizeOrder;
use App\Models\CakeBuilderDetail;
use App\Models\FeatureStatus;
use App\Models\CakeComponent;

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
    $details = CakeBuilderDetail::all();
    $cakeBuilderData = DB::table('feature_status')->where('name', 'cake_builder')->first();
    $cakeBuilderStatus = $cakeBuilderData->status;

    $cakeComponents = CakeComponent::all();

    $flavorLayer = CakeComponent::where('layer', 'flavor')->where('availability', '1')->get();
    $fillingLayer = CakeComponent::where('layer', 'filling')->where('availability', '1')->get();
    $icingLayer = CakeComponent::where('layer', 'icing')->where('availability', '1')->get();
    $topLayer = CakeComponent::where('layer', 'topborder')->where('availability', '1')->get();
    $bottomLayer = CakeComponent::where('layer', 'bottomborder')->where('availability', '1')->get();
    $decorLayer = CakeComponent::where('layer', 'decoration')->where('availability', '1')->get();


    return view('pages.customize', [
      'details' => $details,
      'cakeBuilderStatus' => $cakeBuilderStatus,
      'cakeComponents' => $cakeComponents,
      'flavorLayer' => $flavorLayer,
      'fillingLayer' => $fillingLayer,
      'icingLayer' => $icingLayer,
      'topLayer' => $topLayer,
      'bottomLayer' => $bottomLayer,
      'decorLayer' => $decorLayer,


    ]);
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

  function forgotPassword()
  {
    return view('auth.forgot-password');
  }

  function privacy()
  {
    return view('pages.privacy');
  }

  function terms()
  {
    return view('pages.terms');
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
  
      request()->session()->forget('track_orderId');


      if ($orderDetails->isEmpty() && $customizeOrderDetails->isEmpty()) {
        $error = 'No order details found.';
      }

        return view('pages.track')->with([
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

    $userRole = Auth::user()->role_id;

    switch ($userRole) {
        case 1:
            return redirect()->route('user.list');
        case 2:
            return view('home');
        case 3:
          return redirect()->route('admin.dashboard');
        case 4:
          return redirect()->route('admin.dashboard');
        case 5:
          return redirect()->route('activeOrders');
        case 6:
          return redirect()->route('activeOrders');
        default:
            return view('home');
    }
  }


}
