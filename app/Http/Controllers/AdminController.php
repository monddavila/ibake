<?php

namespace App\Http\Controllers;

use App\Models\CustomizeOrderDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use App\Models\CustomizeOrder;
use Carbon\Carbon;
use App\Notifications\OrderStatusUpdated;
use App\Notifications\OrderApproved;
use App\Notifications\OrderRejected;
use Illuminate\Support\Facades\Validator;




class AdminController extends Controller
{
  public function viewUsers()
  {
    $users = User::with('role') // having a 'role' relationship in your User model
        ->paginate(10);

    return view('admin.pages.users')->with(['users' => $users]);
  }

  public function showAddUsersForm()
  {
    return view('admin.pages.users-add');
  }

  public function addUser(Request $request)
  {
    
    $request->validate([
      'firstname' => 'required|string|max:255',
      'lastname' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'role_id' => 'required',
      'phone' => 'required|string|unique:users',
      'address' => 'required|string|max:255',
      'password' => 'required|string|confirmed',
    ]);



    $user = User::create([
      'firstname' => $request->input('firstname'),
      'lastname' => $request->input('lastname'),
      'email' => $request->input('email'),
      'usertype' => $request->input('role_id'),
      'password' => Hash::make($request->input('password')),
      'phone' => $request->input('phone'),
      'address' => $request->input('address'),
    ]);

    // Dump and die to inspect the created user
    //dd('test');

    return redirect()->back()->with('message', 'User added successfully!');
  }

  public function deleteUser($id)
  {
    // Find the user by ID
    $user = User::findOrFail($id);

    // Delete the user
    $user->delete();

    // Optionally, you can add a success message to the session
    session()->flash('message', 'User deleted successfully.');

    // Redirect to the user list or any other desired page
    return redirect()->route('user.list');
  }

  public function editUser($id)
  {
    $user = User::findOrFail($id);
    $role = $user->role;
    $roles = role::all();


    return view('admin.pages.users-edit', compact('user', 'role', 'roles'));
  }

  public function updateUser(Request $request, $id)
  {
          $user = User::find($id);

          // Get the current timestamp
           $currentTimestamp = now();

          $request->validate([
              'firstname' => 'required|string|max:255',
              'lastname' => 'required|string|max:255',
              'email' => [
                  'required',
                  'string',
                  'email',
                  'max:255',
                  Rule::unique('users')->ignore($user->id),
              ],
              'role_id' => 'required',
              'phone' => [
                  'required',
                  'string',
                  Rule::unique('users')->ignore($user->id),
              ],
              'address' => 'required|string|max:255',
              'password' => 'nullable|string|confirmed',
          ]);

          $user->firstname = $request->firstname;
          $user->lastname = $request->lastname;
          $user->email = $request->email;
          $user->role_id = $request->role_id;
          $user->phone = $request->phone;
          $user->address = $request->address;
          $user->updated_at = $currentTimestamp;

          if (!empty($request->password)) {
              $user->password = Hash::make($request->password);
          }

          $user->save();

          session()->flash('message', 'User data updated successfully.');

          return redirect()->back();
  }      


  public function searchUser(Request $request)
  {

    $query = $request->input('query');
    $sortBy = $request->input('sortBy');
    $sortDirection = $request->input('sortDirection');

    // Perform the necessary database query based on the search query and sorting options
    // Example query for item search and sorting:
    $results = User::where('firstname', 'like', '%' . $query . '%')
      ->orWhere('lastname', 'like', '%' . $query . '%')
      ->orderBy($sortBy, $sortDirection)
      ->get();

    // Convert created_at column to Carbon instances
    foreach ($results as $result) {
      $result->created_at = Carbon::parse($result->created_at);
    }

    $html = view('admin.pages.users-table')->with(
      ['users' => $results]
    )->render();

    return response()->json(['html' => $html]);
  }

  public function __viewCustomOrders()
  {
    /*$orders = CustomizeOrder::join('users', 'customize_orders.userID', '=', 'users.id')
    ->where('customize_orders.orderStatus', '!=', 4)  4 is fully paid
    ->orderBy('customize_orders.orderStatus', 'asc')
    ->orderBy('customize_orders.created_at', 'desc')
    ->paginate(10);*/

    $orders = CustomizeOrder::with('user')
        ->join('users', 'customize_orders.userID', '=', 'users.id')
        ->select('customize_orders.*', 'users.firstname as user_name')
        ->where('orderStatus', '!=', 4) // fully paid and in queue orders
        ->where('orderStatus', '!=', 7) //cancelled requests
        ->orderBy('customize_orders.orderStatus', 'asc')
        ->orderBy('customize_orders.created_at', 'desc')
        ->paginate(10);


    return view('admin.pages.orders.customize-orders', compact('orders'));
  }

public function SearchCustomOrders(Request $request)
{
    $query = $request->input('query');
    $sortBy = $request->input('sortBy');
    $sortDirection = $request->input('sortDirection');

    
    /*$results = CustomizeOrder::with('user')
        ->where('orderStatus', '!=', 4) // Exclude rows with orderStatus 4 or fully paid
        ->where('orderID', 'like', '%' . $query . '%')
        ->orderBy($sortBy, $sortDirection)
        ->paginate(10); */

        $results = CustomizeOrder::with('user')
        ->join('users', 'customize_orders.userID', '=', 'users.id')
        ->select('customize_orders.*', 'users.firstname as user_name')
        ->where('orderStatus', '!=', 4)
        ->where('customize_orders.orderID', 'like', '%' . $query . '%')
        ->orderBy($sortBy, $sortDirection)
        ->paginate(10);




    $html = view('admin.pages.orders.customize-orders-table')->with(['orders' => $results])->render();

    return response()->json(['html' => $html]);
    
    
}





  public function __updateCustomerOrders(Request $request, $id)
  {

    if ($request->input('isSelectionOrder') == 1) { 
      $update = DB::table('customize_orders')
                    ->where('customize_orders.orderID', $id)
                    ->update([
                              'updated_at' => now(),
                              'orderStatus' => 2,
                              
                    ]);
    }elseif ($request->input('isSelectionOrder') == 2) {
      $update = DB::table('customize_orders')
                    ->where('customize_orders.orderID', $id)
                    ->update([
                              'invoice_details' => $request->input('invoice_details'),
                              'cakePrice' => $request->input('cakePrice'),
                              'updated_at' => now(),
                              'orderStatus' => 2,
                    ]);
    }
    //Sending Email if customize order request is apporved and ready for payment"
  
    $cusOrder = CustomizeOrder::where('orderID', $id)->first();
    $orderId = $id;
    $userId = $cusOrder->userID;
    $user = User::find($userId); // Fetch the user by their ID
    $cusname = ($user->firstname . " ". $user->lastname);

    $user->notify(new OrderApproved($cusname, $cusOrder, $orderId));

    return redirect(route('customOrders'));
  }


  public function __updateCustomerRejectOrders(Request $request, $id)
  {
      $update = DB::table('customize_orders')
                    ->where('customize_orders.orderID', $id)
                    ->update([
                              'invoice_details' => $request->input('invoice_details'),
                              'updated_at' => now(),
                              'orderStatus' => 5,
                    ]);

    //Sending Email if customize order request is declined"
  
    $cusOrder = CustomizeOrder::where('orderID', $id)->first();
    $orderId = $id;
    $userId = $cusOrder->userID;
    $user = User::find($userId); // Fetch the user by their ID
    $cusname = ($user->firstname . " ". $user->lastname);

    $user->notify(new OrderRejected($cusname, $cusOrder, $orderId));



    return redirect(route('customOrders'));
  }

  public function processOrder(Request $request, $id)
  {
    // Retrieve the action (approve or reject)
    $action = $request->input('action');

    // Rest of your logic...

    if ($action == 'approve') {
        return $this->__updateCustomerOrders($request, $id);
    } elseif ($action == 'reject') {
        return $this->__updateCustomerRejectOrders($request, $id);
    }
  }

  public function updateOrderStatus(Request $request, $id)
  {

    //Retrieve order status
    $orderStatusSession = session('action_order_status');
    $orderStatus=null;

    if ($orderStatusSession == 'Process') {
          $orderStatus='Processing';
    }elseif ($orderStatusSession == 'Cancel') {
          $orderStatus='Cancelled';
    }elseif ($orderStatusSession == 'Ready') {
          $orderStatus='On Delivery';
    }elseif ($orderStatusSession == 'Complete') {
      $orderStatus='Completed';
    }elseif ($orderStatusSession == 'Reconsider') {
      $orderStatus='Pending'; 
    }


    //isSelectionOrder => 1 = Shop Order 2 = Custom Cake Order//
    
    if ($request->input('isSelectionOrder') == 1) { 
      $update = DB::table('orders')
                    ->where('orders.order_id', $id)
                    ->update([
                              'updated_at' => now(),
                              'order_status' => $orderStatus,
                              
                    ]);
    }elseif ($request->input('isSelectionOrder') == 2) {
      $update = DB::table('customize_order_details')
                    ->join('customize_orders', 'customize_order_details.customOrder_id', '=', 'customize_orders.id')
                    ->where('customize_orders.orderID', $id)
                    ->update([
                        'customize_order_details.updated_at' => now(),
                        'customize_order_details.order_status' => $orderStatus,
                    ]);
    }
      if($orderStatus == 'Processing'){
        return redirect(route('activeOrders'));
      }elseif ($orderStatus == 'Cancelled'){
        return redirect(route('cancelledOrders'));
      }elseif ($orderStatus == 'On Delivery'){

        //CODE BLOCK FOR EMAIL SENDING TO CUSTOMER if order is ready for pickup or on delivery"
        $customOrder = DB::table('customize_order_details')
        ->join('customize_orders', 'customize_order_details.customOrder_id', '=', 'customize_orders.id')
        ->where('customize_orders.orderID', $id)
        ->select('customize_order_details.*', 'customize_orders.*')
        ->first();
    
        $order = Order::where('order_id', $id)->first();
        $orderId = $id;
    
        if ($customOrder) {
            $userId = $customOrder->user_id;
        } else {
            $userId = $order->user_id;
        }
    
        $user = User::find($userId); // Fetch the user by their ID
        $user->notify(new OrderStatusUpdated($order, $customOrder, $orderId));

        return redirect(route('readyOrders'));
      }elseif ($orderStatus == 'Completed'){
        return redirect(route('completedOrders'));
      }elseif ($orderStatus == 'Pending'){
        return redirect(route('activeOrders'));
      }
    
  }

  public function processOrderStatus(Request $request, $id)
  {
    // Retrieve the actions
    $action = $request->input('action');

    
         //Active Orders Section
    if ($action == 'Process') {
        $action_order_status = $action;
        session(['action_order_status' => $action_order_status]);
        return $this->updateOrderStatus($request, $id);

      } elseif ($action == 'Cancel') {
        $action_order_status = $action;
        session(['action_order_status' => $action_order_status]);
        return $this->updateOrderStatus($request, $id);

         //Ongoing Orders Section
      } elseif ($action == 'Ready') {
        $action_order_status = $action;
        session(['action_order_status' => $action_order_status]);
        return $this->updateOrderStatus($request, $id);

          //Delivery Orders Section
      } elseif ($action == 'Complete') {
        $action_order_status = $action;
        session(['action_order_status' => $action_order_status]);
        return $this->updateOrderStatus($request, $id);

          //Cancelled Orders Section
      } elseif ($action == 'Reconsider') {
        $action_order_status = $action;
        session(['action_order_status' => $action_order_status]);
        return $this->updateOrderStatus($request, $id);
      }
    
  }

}
?>
