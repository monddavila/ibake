<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;




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
      'phone' => 'required|string|unique:users',
      'address' => 'required|string|max:255',
      'password' => 'required|string|confirmed',
    ]);



    $user = User::create([
      'firstname' => $request->input('firstname'),
      'lastname' => $request->input('lastname'),
      'email' => $request->input('email'),
      'password' => Hash::make($request->input('password')),
      'phone' => $request->input('phone'),
      'address' => $request->input('address'),
    ]);

    // Dump and die to inspect the created user
    //dd('test');

    return redirect()->back()->with('success', 'User added successfully.');
  }
}
