<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function view_users()
    {
        return view('admin.pages.users');
    }

    public function showAddUsersForm()
    {
        return view('admin.pages.addusers');
    }

    public function add_user(Request $request)
    {
    $userData = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|unique:users',
        'address' => 'required|string|max:255',
        'password' => 'required|string|confirmed',
    ]);

    $user = new User;
    $user->firstname = $userData['firstname'];
    $user->lastname = $userData['lastname'];
    $user->email = $userData['email'];
    $user->phone = $userData['phone'];
    $user->address = $userData['address'];
    $user->password = Hash::make($userData['password']);

    $user->save();

    return redirect()->back()->with('success', 'User added successfully.');
    }

}
