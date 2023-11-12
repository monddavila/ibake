<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Order;
use App\Models\CustomizeOrderDetail;
use App\Models\CustomizeOrder;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\CustomCakeReview;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportsController extends Controller
{
    public function viewCustomerRecords()
    {
        $orders = Order::with('user')
            ->where('order_status', '=', 'Completed')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
                $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
                $order->name = $order->user->firstname . ' ' . $order->user->lastname;
                $order->type = 'Shop Order';
                return $order;
            });

        $customOrderDetails = CustomizeOrderDetail::with('user')
            ->where('order_status', '=', 'Completed')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
                $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
                $order->name = $order->user->firstname . ' ' . $order->user->lastname;
                $order->type = 'Custom Order';
                return $order;
            });

        $allOrders = $orders->concat($customOrderDetails);

        return view('admin.pages.reports.customer-records')->with([
            'allOrders' => $allOrders,

        ]);
    }

    public function searchCustomer(Request $request)
    {

        $query = $request->input('query');
        $sortBy = $request->input('sortBy');
        $sortDirection = $request->input('sortDirection');
        
        $orders = Order::with('user')
            ->where('order_status', '=', 'Completed')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->whereHas('user', function ($subQuery) use ($query) {
                    $subQuery->where('firstname', 'like', '%' . $query . '%');
                })
                ->orWhere('order_id', 'like', '%' . $query . '%');
            })
            ->orderBy($sortBy, $sortDirection)
            ->get()
            ->map(function ($order) {
                $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
                $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
                $order->name = $order->user->firstname . ' ' . $order->user->lastname;
                $order->type = 'Shop Order';
                return $order;
            });
        
        $customOrderDetails = CustomizeOrderDetail::with('user')
            ->where('order_status', '=', 'Completed')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->whereHas('user', function ($subQuery) use ($query) {
                    $subQuery->where('firstname', 'like', '%' . $query . '%');
                })
                ->orWhere('order_id', 'like', '%' . $query . '%');
            })
            ->orderBy($sortBy, $sortDirection)
            ->get()
            ->map(function ($order) {
                $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
                $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
                $order->name = $order->user->firstname . ' ' . $order->user->lastname;
                $order->type = 'Custom Order';
                return $order;
            });
        
        $allOrders = $orders->concat($customOrderDetails)->all();
        

    $html = view('admin.pages.reports.customer-records-table')->with(
        ['allOrders' => $allOrders]
      )->render();

      return response()->json(['html' => $html]);

    }

    public function viewSalesReport()
    {
        $orders = Order::with('user')
            ->where('payment_status', 'Fully Paid')
            ->where('order_status', '!=', 'Cancelled')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
                $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
                $order->name = $order->user->firstname . ' ' . $order->user->lastname;
                $order->type = 'Shop Order';
                $order->payment_balance = null;
                return $order;
            });

           // dd($orders); 11

        $customOrderDetails = CustomizeOrderDetail::with('user')
            ->whereIn('payment_status', ['Fully Paid', 'Partially Paid'])
            ->where('order_status', '!=', 'Cancelled')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
                $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
                $order->name = $order->user->firstname . ' ' . $order->user->lastname;
                $order->type = 'Custom Order';
                return $order;
            });

           //dd($customOrderDetails); 18

        $allOrders = $orders->concat($customOrderDetails);

        //dd($allOrders);

        return view('admin.pages.reports.sales-report')->with([
            'allOrders' => $allOrders,

        ]);
    }



/* $totalInventoryValue = Product::sum(\DB::raw('price * available_qty'));

    $shopPaymentsReceived = Order::where('payment_status', 'Fully Paid')->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $customPaymentsReceived = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('order_status', '!=', 'Cancelled')->sum('total_price');
    $customPaymentsReceivedHalf = CustomizeOrderDetail::where('payment_status', 'Partially Paid')->where('order_status', '!=', 'Cancelled')->sum('payment_balance');

    $paymentsReceived = $shopPaymentsReceived + $customPaymentsReceived + $customPaymentsReceivedHalf ;

    $totalSales = $paymentsReceived + $customPaymentsReceivedHalf;
    */

    public function searchSalesRecord(Request $request)
    {

        $query = $request->input('query');
        $sortBy = $request->input('sortBy');
        $sortDirection = $request->input('sortDirection');
        
        $orders = Order::with('user')
        ->where('payment_status', '=', 'Fully Paid')
        ->where('order_status', '!=', 'Cancelled')
   
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->Where('order_id', 'like', '%' . $query . '%');
            })
            ->orderBy($sortBy, $sortDirection)
            ->get()
            ->map(function ($order) {
                $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
                $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
                $order->name = $order->user->firstname . ' ' . $order->user->lastname;
                $order->type = 'Shop Order';
                return $order;
            });
        
        $customOrderDetails = CustomizeOrderDetail::with('user')
        ->whereIn('payment_status', ['Fully Paid', 'Partially Paid'])
        ->where('order_status', '!=', 'Cancelled')

            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->Where('order_id', 'like', '%' . $query . '%');
            })
            ->orderBy($sortBy, $sortDirection)
            ->get()
            ->map(function ($order) {
                $order->order_date = Carbon::parse($order->created_at)->format('d M Y');
                $order->delivery_date = Carbon::parse($order->delivery_date)->format('d M Y');
                $order->name = $order->user->firstname . ' ' . $order->user->lastname;
                $order->type = 'Custom Order';
                return $order;
            });
        
        $allOrders = $orders->concat($customOrderDetails)->all();
        

    $html = view('admin.pages.reports.sales-report-table')->with(
        ['allOrders' => $allOrders]
      )->render();

      return response()->json(['html' => $html]);

    }
}
