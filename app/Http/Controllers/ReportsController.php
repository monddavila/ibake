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

        $allOrders = $orders->concat($customOrderDetails);

        $shopPaymentsReceived = Order::where('payment_status', 'Fully Paid')->where('order_status', '!=', 'Cancelled')->sum('total_price');
        $customPaymentsReceived = CustomizeOrderDetail::where('payment_status', 'Fully Paid')->where('order_status', '!=', 'Cancelled')->sum('total_price');
        $customPaymentsReceivedHalf = CustomizeOrderDetail::where('payment_status', 'Partially Paid')->where('order_status', '!=', 'Cancelled')->sum('payment_balance');
    
        $paymentsReceived = $shopPaymentsReceived + $customPaymentsReceived + $customPaymentsReceivedHalf ;
    
        $totalSales = $paymentsReceived + $customPaymentsReceivedHalf;
    

        return view('admin.pages.reports.sales-report')->with([
            'allOrders' => $allOrders,
            'paymentsReceived' => $paymentsReceived,
            'customPaymentsReceivedHalf' => $customPaymentsReceivedHalf,
            'totalSales' => $totalSales,

        ]);
    }


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

        function shopOrders(Request $request)
    {
        // Completed Shop Orders
        $shopOrders = Order::
            with('orderItems.product');

            if (isset($request->sort_by) && isset($request->order_by)) {
            $shopOrders = $shopOrders->orderBy($request->sort_by, $request->order_by);
            }

        $shopOrders = $shopOrders->paginate(15);

        $orderDetails = CustomizeOrderDetail::where('order_status', 'Completed')
            ->with('CustomizeOrder')
            ->get();

        return view('admin.pages.reports.shop-orders')->with([
            'shopOrders' => $shopOrders,
            'orderDetails' => $orderDetails,
        ]);
    }

    public function customOrderSummary(Request $request)
    {
        // Completed Custom Cake Orders
        $shopCustomOrders = CustomizeOrderDetail::orderBy('created_at', 'desc')->paginate(15);

        if (isset($request->sort_by) && isset($request->order_by)) {
            $shopCustomOrders = CustomizeOrderDetail::orderBy($request->sort_by, $request->order_by)->paginate(15);
        }

        $orderDetails = CustomizeOrderDetail::where('order_status', 'Completed')
            ->with('CustomizeOrder')
            ->get();

        return view('admin.pages.reports.custom-orders')->with([
            'shopCustomOrders' => $shopCustomOrders,
            'orderDetails' => $orderDetails,
        ]);
    }

    public function transactionRecords(Request $request)
    {
        $totalEwallets = Session::has('totalEwallets') ? Session::get('totalEwallets') : 0;
        $totalCards = Session::has('totalCards') ? Session::get('totalCards') : 0;
        $totalBank = Session::has('totalBank') ? Session::get('totalBank') : 0;
        $totalCash = Session::has('totalCash') ? Session::get('totalCash') : 0;
        $totalReceivables = Session::has('totalReceivables') ? Session::get('totalReceivables') : 0;

        $totalOnhand = $totalEwallets + $totalCards + $totalBank + $totalCash;

        $totalSales = $totalOnhand + $totalReceivables;

        $sellingProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(price) as total_price'))
        ->groupBy('product_id')
        ->orderBy('total_quantity', 'desc')
        ->with('product')
        ->paginate(8);


        return view('admin.pages.reports.transaction-records')->with([
            'sellingProducts' => $sellingProducts,
            'totalEwallets' => $totalEwallets,
            'totalCards' => $totalCards,
            'totalBank' => $totalBank,
            'totalCash' => $totalCash,
            'totalOnhand' => $totalOnhand,
            'totalReceivables' => $totalReceivables,
            'totalSales' => $totalSales,
        ]);
    }




}
