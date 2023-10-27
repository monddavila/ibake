<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

  public function create()
  {
    return view('auth.register');
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
  /*public function redirect()
  {
    if (
      !empty(Auth::user()) && Auth::user()->usertype == 1
    ) {
      return view('admin.home');
    }
    return redirect(route('home'));
  }*/

  /**
   * User log in method
   */
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(route('login'));
  }

  public function switchUser()
  {
    dd('test');
      Auth::logout();
      return redirect()->route('login');
  }


  /**
   *  Store a newly created user in storage.
   */
  public function store(Request $request)
  {
    $phoneValidationPattern = '/^(?:\+63|0)[1-9]\d{9}$/';

    $request->validate([
    'firstname' => 'required|string|max:50',
    'lastname' => 'required|string|max:50',
    'email' => 'required|string|email|max:50|unique:users',
    'phone' => ['required', 'string', 'max:11', 'unique:users', 'regex:' . $phoneValidationPattern],
    'address' => 'required|string|max:100',
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
