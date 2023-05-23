<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
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
    $this->middleware('guest')->except('logout');
  }

  /**
   * Display the Login Page
   */
  public function login()
  {
    return view('auth.login');
  }

  /**
   * User log in method.
   * Created accounts are set to Admin as as now which will be redirected to
   * the dashboard.
   * 'usertype' value determines if the user is an admin or not.
   * usertype with a value of 0 is a Customer.
   * usertype with a value of 1 is an Admin.
   * Customers will be redirected to the homepage later in the development.
   * 
   */
  public function redirect()
  {
    if (
      !empty(Auth::user()) && Auth::user()->usertype == 1
    ) {
      return view('admin.home');
    }
    return redirect(route('home'));
  }

  /**
   * User log in method
   */
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(route('home'));
  }

  public function create()
  {
    return view('auth.register');
  }

  /**
   *  Store a newly created user in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:11|unique:users',
        'address' => 'required|string|max:255',
        'password' => 'required|string|confirmed',
    ]);

    $user = User::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'address' => $request->address,
    ]);

    return redirect(route('login'))->with('success', 'Registered successfully! You can now login with your credentials.');
  }
}
