<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\CustomizeOrderDetail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\CustomizeOrder;


class CustomerController extends Controller
{
  public function index(Request $request)
  {
      $orders = DB::table('customize_orders')
          ->select('*')
          ->where('customize_orders.userID', Auth::user()->id);
  
      if (isset($request->sort_by) && isset($request->order_by)) {
          $orders = $orders->orderBy($request->sort_by, $request->order_by);
      }
  
      $orders = $orders
          ->orderBy('orderStatus', 'asc')
          ->orderBy('created_at', 'desc')
          ->get();
  
      return view('customer.chome', compact('orders'));
  }

  public function viewCustomerAccount(Request $request)
  {
      $userId = Auth::user()->id; // Get the ID of the currently logged-in user.

      $user = User::find($userId);

      return view('customer.pages.customer-account', compact('user'));
  }

  public function viewCustomerPassword(Request $request)
  {
      $userId = Auth::user()->id; // Get the ID of the currently logged-in user.

      $user = User::find($userId);

      return view('customer.pages.customer-password', compact('user'));
  }
  

  public function updateCustomerAccount(Request $request, $id)
  {

          $phoneValidationPattern = '/^(?:\+63|0)[1-9]\d{9}$/';

          $loggedUser = User::find($id);

          // Get the current timestamp
           $currentTimestamp = now();

          $request->validate([
              'firstname' => 'required|string|max:50',
              'lastname' => 'required|string|max:50',
              'email' => [
                  'required',
                  'string',
                  'email',
                  'max:100',
                  Rule::unique('users')->ignore($loggedUser->id),
              ],
              'phone' => ['required', 'string', 'max:11', Rule::unique('users')->ignore($loggedUser->id), 'regex:' . $phoneValidationPattern],
              'address' => 'required|string|max:100',
          ]);

          $loggedUser->firstname = $request->firstname;
          $loggedUser->lastname = $request->lastname;
          $loggedUser->email = $request->email;
          $loggedUser->phone = $request->phone;
          $loggedUser->address = $request->address;
          $loggedUser->updated_at = $currentTimestamp;

          $loggedUser->save();

          session()->flash('message', 'Your personal information is successfully updated.');

          return redirect()->back();
  }      

  public function updateCustomerPassword(Request $request)
  {
    $userId = Auth::user()->id;
    $user = User::find($userId);

    $request->validate([
        'current_password' => 'required|string',
        'password' => 'required|string|confirmed',
    ]);

    // Check if the provided current_password matches the user's actual password
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    if (!empty($request->password)) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    session()->flash('message', 'Password updated successfully.');

    return redirect()->back();
  }



    function customerActiveOrders(Request $request)
  {
    $userId = Auth::user()->id; // Get the ID of the currently logged-in user.

      $activeOrders = Order::where('user_id', $userId)
        ->with('orderItems.product') // Eager load the related OrderItem;
        ->whereIn('order_status', ['Pending', 'Processing', 'Ready', 'On Delivery']);

        if (isset($request->sort_by) && isset($request->order_by)) {
          $activeOrders = $activeOrders->orderBy($request->sort_by, $request->order_by);
        }

      $activeOrders = $activeOrders->get()
        ->map(function ($order) {
        $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
        return $order;
      });


      $activeCustomOrders = CustomizeOrderDetail::where('user_id', $userId)
      ->whereIn('order_status', ['Pending', 'Processing', 'Ready', 'On Delivery']);
      
      if (isset($request->sort_by) && isset($request->order_by)) {
        $activeCustomOrders = $activeCustomOrders->orderBy($request->sort_by, $request->order_by);
      }
      
      $activeCustomOrders = $activeCustomOrders->get()
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

  function customerCompletedOrders(Request $request)
  {
    $userId = Auth::user()->id; // Get the ID of the currently logged-in user.

    $completedOrders = Order::where('user_id', $userId)
        ->with('orderItems.product') // Eager load the related OrderItem;
        ->whereIn('order_status', ['Completed', 'Cancelled', 'Refunded']);

        if (isset($request->sort_by) && isset($request->order_by)) {
          $completedOrders = $completedOrders->orderBy($request->sort_by, $request->order_by);
        }

      $completedOrders = $completedOrders->get()
        ->map(function ($order) {
        $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
        return $order;
      });


      $completedCustomOrders = CustomizeOrderDetail::where('user_id', $userId)
      ->whereIn('order_status', ['Completed', 'Cancelled', 'Refunded']);
      
      if (isset($request->sort_by) && isset($request->order_by)) {
        $completedCustomOrders = $completedCustomOrders->orderBy($request->sort_by, $request->order_by);
      }
      
      $completedCustomOrders = $completedCustomOrders->get()
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
