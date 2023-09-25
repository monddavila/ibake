<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class HomeController extends Controller
{

  public function home()
  {
    return view("home");
  }

  function contact()
  {
    return view('pages.contact');
  }

  function about()
  {
    return view('pages.about');
  }

  function chef()
  {
    return view('pages.chef');
  }

  function customize()
  {
    return view('pages.customize');
  }

  /**function gallery()
  {
    return view('pages.gallery');
  }

  function portfolio()
  {
    return view('pages.portfolio');
  }
  */
  function blog()
  {
    return view('pages.blog');
  }

  function faqs()
  {
    return view('pages.faqs');
  }

  function track()
  {
    return view('pages.track');
  }


  public function redirect()
  {
    if (!Auth::check()) {
      return view('home');
    }

    return Auth::user()->role_id == '1' ? view('admin.home') : view('home');

    /* $usertype = Auth::user()->role_id;
    // Admin Account
    if ($usertype == '1') {
      return view('admin.home');
    }

    // Other Accounts - will include guest, manager and bakers separately
    else {
      return view('home');
    } */
  }
}
