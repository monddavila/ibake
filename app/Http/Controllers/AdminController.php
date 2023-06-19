<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;




class AdminController extends Controller
{
  public function viewUsers()
  {
    return view('admin.pages.users');
  }

  public function showAddUsersForm()
  {
    return view('admin.pages.addusers');
  }

  public function addUser(Request $request)
  {
        
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'usertype' => 'required',
            'phone' => 'required|string|unique:users',
            'address' => 'required|string|max:255',
            'password' => 'required|string|confirmed',
        ]);

        
        
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'usertype' => $request->input('usertype'),
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

  public function searchUser(Request $request)
  {

    $query = $request->input('query');
    $sortBy = $request->input('sortBy');
    $sortDirection = $request->input('sortDirection');

    // Perform the necessary database query based on the search query and sorting options
    // Example query for item search and sorting:
    $results = User::where('name', 'like', '%' . $query . '%')
      ->orderBy($sortBy, $sortDirection)
      ->get();

    $html = view('admin.pages.users-table')->with(
      ['user' => $results]
    )->render();

    return response()->json(['html' => $html]);
  }

}
