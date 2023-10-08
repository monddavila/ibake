<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
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

  public function __viewCustomOrders(){
    $orders = DB::table('customize_orders')
                    ->select('*')
                    ->get();

    return view('admin.pages.orders.customize-orders', compact('orders'));
  }
  public function __updateCustomerOrders(Request $request, $id)
  {
    if ($request->input('isSelectionOrder') == 1) { 
      $update = DB::table('customize_orders')
                    ->where('customize_orders.orderID', $id)
                    ->update([
                              'orderStatus' => 2,
                    ]);
    }elseif ($request->input('isSelectionOrder') == 2) {
      $update = DB::table('customize_orders')
                    ->where('customize_orders.orderID', $id)
                    ->update([
                              'invoice_details' => $request->input('invoice_details'),
                              'cakePrice' => $request->input('cakePrice'),
                              'orderStatus' => 2,
                    ]);
    }

    return redirect(route('customOrders'));
  }
  public function __updateCustomerRejectOrders($id)
  {
      $update = DB::table('customize_orders')
                    ->where('customize_orders.orderID', $id)
                    ->update([
                              'orderStatus' => 3,
                    ]);
      return redirect(route('customOrders'));
  }
}
?>
