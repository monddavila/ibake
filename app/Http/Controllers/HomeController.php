<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class HomeController extends Controller
{

    public function index()
    {
        return view("home");
    }
    

    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        /**Admin Account**/
        if($usertype=='1')
        {
            return view('admin.home');
        }

        /**Other Accounts - will include guest, manager and bakers separately**/
        else
        {
            return view('home');
        }
    }

}
