<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth')->only(['create']);
  }

  /**
   * Display the Registration Page
   */
  public function create()
  {
    return view('auth.register');
  }

  /**
   *  Store a newly created user in storage.
   */
  public function store(Request $request)
  {
    // Validate user input
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'phone' => 'required|string|max:11|min:11|unique:users',
      'address' => 'required|string|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ]);

    // Create new user then adds it to the database.
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'phone' => $request->phone,
      'address' => $request->address,
    ]);

    // Redirect to login after successful registration
    return redirect(route('login'));
  }
}
