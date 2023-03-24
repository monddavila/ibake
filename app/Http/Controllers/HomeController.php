<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
