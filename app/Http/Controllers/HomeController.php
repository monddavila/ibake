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

  function portfolio()
  {
    return view('pages.portfolio');
  }


  public function redirect()
  {
    $usertype = Auth::user()->usertype;

    /**Admin Account**/
    if ($usertype == '1') {
      return view('admin.home');
    }

    /**Other Accounts - will include guest, manager and bakers separately**/
    else {
      return view('home');
    }
  }
}
