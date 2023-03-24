<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
  // iBake Contact Us page
  public function index()
  {
    return view('about_us');
  }
}
