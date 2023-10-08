<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomizeOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(){
        $orders = DB::table('customize_orders')
                    ->select('*')
                    ->where('customize_orders.userID', Auth::user()->id)
                    ->get();
        // dd($orders);
        return view('customer.chome', compact('orders'));
    }
}
