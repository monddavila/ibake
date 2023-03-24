<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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
    if (!empty(Auth::user()) && Auth::user()->usertype == 1) {

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
}
