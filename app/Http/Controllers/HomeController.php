<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class HomeController extends Controller
{
  // iBake Homepage
  public function home()
  {
    return view('home');
  }

  // iBake Contact Us page
  public function contact()
  {
    return view('contact');
  }
}
