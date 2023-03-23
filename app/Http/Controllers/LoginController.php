<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }

  public function redirect()
  {

    /**Admin Account**/
    if (!empty(Auth::user()) && Auth::user()->usertype == 1) {

      return view('admin.home');
    }
    return view('auth.login');

    // $usertype = Auth::user()->usertype;

    /**Other Accounts - will include guest, manager and bakers separately**/
  }
}
