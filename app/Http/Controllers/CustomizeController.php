<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomizeOrder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductsController;
use App\Models\CustomizeOrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CustomizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $celebrantName = $request->input('celebrant_name_1');
        $celebrantBirthday = $request->input('celebrant_birthday_1');
        $shippingMethod = $request->input('shipping_method_1');
        $deliveryDate = $request->input('delivery_date_1');
        $deliveryTime = $request->input('delivery_time_1');
        $location = $request->input('location_1');
        $town = $request->input('town_1', null);
        $province = $request->input('province_1');
        $postcode = $request->input('postcode_1');
        

        /* Check if 'town' exists in the session
        if (isset($town)) {
            $town = $request->input('town');
        } else {
            // Set a default value if 'town' doesn't exist in the session
            $town = null;
        } */
    
        if($shippingMethod == 'Delivery'){
            $address = $location . '||' . $town . '||' . $province . '||' . $postcode;
        }else{
            $address = null;
        }

        DB::table('customize_orders')->insert([
            'userID' => $request->user()->id,
            'orderID' => date("sdmY"),
            'isSelectionOrder' => 1,
            'cakeOrderImage' => null,
            'cakeSize' => $request->input('cakeSize'),
            'cakeFlavor' => $request->input('cakeFlavor'),
            'cakeFilling' => $request->input('cakeFilling'),
            'cakeIcing' => $request->input('cakeIcing'),
            'cakeTopBorder' => $request->input('cakeTopBorder'),
            'cakeBottomBorder' => $request->input('cakeBottomBorder'),
            'cakeDecoration' => $request->input('cakeDecoration'),
            'cakeMessage' => $request->input('cakeMessage'),
            'cakePrice' => $request->input('cakePrice'),
            'cake_size' => null,
            'cake_flavor' => null,
            'cake_icing' => null,
            'celebrant_name' => $celebrantName,
            'celebrant_birthday' => $celebrantBirthday,
            'budget' => null,
            'shipping_method' => $shippingMethod,
            'delivery_date' => $deliveryDate,
            'delivery_time' => $deliveryTime,
            'address' => $address,
            'created_at' => now(),
            'updated_at' => null,
            'orderStatus' => 1
        ]);


        return redirect('/customer');
    }

    public function ___insertCustomOrderImage(Request $request)
    {
        // Access data from Step 1
        $cakeOrderImage = $request->file('cakeOrderImage');
        $cakeMessage = $request->input('cakeMessage');

        // Access data from Step 2
        $cakeSizeDetail = $request->input('cake_size');
        $icing = $request->input('icing');
        $cakeFlavor = $request->input('cake_flavor');
        $celebrantName = $request->input('celebrant_name');
        $celebrantBirthday = $request->input('celebrant_birthday');
        $budget = $request->input('budget');
        $shippingMethod = $request->input('shipping_method');
        $deliveryDate = $request->input('delivery_date');
        $deliveryTime = $request->input('delivery_time');
        $location = $request->input('location');
        $town = $request->input('town', null);
        $province = $request->input('province');
        $postcode = $request->input('postcode');

         /* Check if 'town' exists in the session
        if (isset($town)) {
            $town = $request->input('town');
        } else {
            // Set a default value if 'town' doesn't exist in the session
            $town = null;
        } */
    
        if($shippingMethod == 'Delivery'){
            $address = $location . '||' . $town . '||' . $province . '||' . $postcode;
        }else{
            $address = null;
        }



        $directory = 'images' . DIRECTORY_SEPARATOR . 'customerUploadedOrderCake';
        $newImgName = uniqid() . '.' . $request->cakeOrderImage->getClientOriginalExtension();
        $stored = $request->file('cakeOrderImage')->move($directory, $newImgName);

        DB::table('customize_orders')->insert([
            'userID' => $request->user()->id,
            'orderID' => date("sdmY"),
            'isSelectionOrder' => 2,
            'cakeOrderImage' => $stored,
            'cakeSize' => null,
            'cakeFlavor' => null,
            'cakeFilling' => null,
            'cakeIcing' => null,
            'cakeTopBorder' => null,
            'cakeBottomBorder' => null,
            'cakeDecoration' => null,
            'cakeMessage' => $cakeMessage,
            'cakePrice' => null,
            'cake_size' => $cakeSizeDetail,
            'cake_flavor' => $cakeFlavor,
            'cake_icing' => $icing,
            'celebrant_name' => $celebrantName,
            'celebrant_birthday' => $celebrantBirthday,
            'budget' => $budget,
            'shipping_method' => $shippingMethod,
            'delivery_date' => $deliveryDate,
            'delivery_time' => $deliveryTime,
            'address' => $address,
            'created_at' => now(),
            'updated_at' => null,
            'orderStatus' => 1
        ]);

        return redirect('/customer');
    }

    

    public function validateCustomOrder(Request $request)
    {
    $rules = [
        'cake_size' => 'required',
        'cake_flavor' => 'required',
        'icing' => 'required',
        'budget' => 'required',
        'shipping_method' => 'required',
        'delivery_date' => 'required',
        'delivery_time' => 'required',
    ];

    if ($request->input('shipping_method') === 'Delivery') {
        $rules['location'] = 'required';
        $rules['town'] = 'required';
        $rules['province'] = 'required';
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ]);
    }

    return response()->json(['success' => true]);
    }



    public function storeCustomOrder(Request $request, $token)
    {

    // Check token to prevent resubmission of payment and order storing
    if($token === $request->session()->get('custom_payment_token')) {

            // Retrieve PayMongo Payment IDs
            $paymentSessionId = Session::get('paymentSession_id');
            $paymentIntentId = Session::get('paymentIntent_id');
            
            // Retrieve customize_order id of the the order to display in customize_order_details
            $customOrder_id = session('customOrder_id');
            // Retrieve Item's Order ID
            $customize_order_id = session('customize_order_id');

            // Retrieve remaining balance payment for cake if half paid
            $CakePrice_bal = Session::get('custom_cakeBal'); //add to payments table new migration!!


            // Retrieve Orders form data from the session
            $customOrderData = $request->session()->get('customOrder_data');

            $recipientName = $customOrderData['recipient_name'];
            $streetAddress = $customOrderData['street_address'];
            
            if (session()->has('customOrder_data') && isset(session('customOrder_data')['town'])) {
                $town = session('customOrder_data')['town'];
            } else {
                $town = null;
            }

            
            $province = $customOrderData['province'];
            $postcode = $customOrderData['postcode'];
            $recipientEmail = $customOrderData['recipient_email'];
            $recipientPhone = $customOrderData['recipient_phone'];
            $shippingMethod = $customOrderData['shipping_method'];
            $deliveryDate = $customOrderData['delivery_date'];
            $deliveryTime = $customOrderData['delivery_time'];
            $paymentOption = $customOrderData['payment_option'];
            $paymentMethod = $customOrderData['payment_method'];
            $orderNotes = $customOrderData['order_notes'];

            if($shippingMethod == 'Delivery'){
                $address = $streetAddress . '||' . $town . '||' . $province . '||' . $postcode;
            }else{
                $address = "";
            }

            //retrieve cake price
            $cakePrice = session('cakePrice');

            if($CakePrice_bal == null){
                $paymentStatus = 'Fully Paid';
            }else{
                $paymentStatus = 'Partially Paid';
            }


            //store data to orders table
            $order = CustomizeOrderDetail::create([
            'user_id' => Auth::id(),
            'customOrder_id' => $customOrder_id,
            'order_id' => $customize_order_id,
            'recipient_name' => $recipientName,
            'recipient_email' => $recipientEmail,
            'recipient_phone' => $recipientPhone,
            'shipping_method' => $shippingMethod,
            'delivery_date' => $deliveryDate,
            'delivery_time' => $deliveryTime,
            'delivery_address' => $address,
            'total_price' => $cakePrice,
            'payment_option' => $paymentOption, 
            'payment_balance' => $CakePrice_bal, 
            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,
            'payment_session_id' => $paymentSessionId,
            'payment_intent_id' => $paymentIntentId,
            'notes' => $orderNotes,
            'created_at' => now(),
            
            ]);

            if($paymentOption == 'Full'){
                $orderStatus = 4;//4 is Fully Payment
            }else{
                $orderStatus = 3;//3 is half paid/Down payment
            }

            //update order status to "Processing" of customize_orders table
            $update = DB::table('customize_orders')
                            ->where('customize_orders.orderID', $customize_order_id)
                            ->update([
                                    'orderStatus' => $orderStatus,
                                    'updated_at' => now(),  
                            ]);

            // Clear the session variable if needed
            $request->session()->forget('customOrder_data');
            $request->session()->forget('customOrder_id');
            $request->session()->forget('cakePrice');
            $request->session()->forget('custom_cakeBal'); //check if still needed!
            session()->forget(['paymentSession_id', 'paymentIntent_id']);
            $request->session()->forget('custom_check_token');
            $request->session()->forget('custom_payment_token');

            return redirect()->route('customer');
        }else{
            return redirect()->route('redirect');
        }
    }


    public function updateCustomOrderBalance(Request $request, $token)
    {

    // Check token to prevent resubmission of payment and order storing
    if($token === $request->session()->get('balance_payment_token')) {
    
    
            // Retrieve customize_order id of the the order to display in customize_order_details
            $customOrder_id = session('customBalance_customizeOrder_id');
            // Retrieve Item's Order ID
            $customize_order_id = session('customBalanceOrder_id');
            // Retrieve PayMongo Payment IDs
            $BalancePaymentIntent = session('BalancePaymentIntent_id'); 


            //update order status to "Processing" of customize_orders table
            $update = DB::table('customize_orders')
                            ->where('customize_orders.orderID', $customize_order_id)
                            ->update([
                                    'orderStatus' => 4, //4 is fully paid
                            ]);

            //update order status to "Processing" of customize_orders table
            $update = DB::table('customize_order_details')
                            ->where('customize_order_details.customOrder_id', $customOrder_id)
                            ->update([
                                    'payment_status' => 'Fully Paid',
                                    'payment_balance' => null,   
                                    'payment_intent_id_balance' => $BalancePaymentIntent,
                            ]);

            // Clear the session variable if needed
            session()->forget('customBalance_customizeOrder_id');
            session()->forget('customBalanceOrder_id');
            session()->forget('BalancePaymentIntent_id');
            $request->session()->forget('balance_check_token');
            $request->session()->forget('balance_payment_token');


            return redirect()->route('customer');
        }else{
            return redirect()->route('redirect');
        }
    }




    public function cancelOrderRequest(Request $request, $id)
    {
    $order = DB::table('customize_orders')->where('customize_orders.orderID', $id)->first();

    if (!$order) {
        // Handle the case where the order doesn't exist
        return redirect(route('customOrders'))->with('error', 'Order not found.');
    }

    // Get the user ID of the logged-in user
    $loggedInUserId = Auth::id();

    if ($order->userID !== $loggedInUserId) {
        // The logged-in user does not have permission to cancel this order
        return redirect(route('customOrders'))->with('error', 'You do not have permission to cancel this order.');
    }

    // Update the order
    $update = DB::table('customize_orders')
        ->where('customize_orders.orderID', $id)
        ->update([
            'updated_at' => now(),
            'orderStatus' => 7,
        ]);

    return redirect(route('customer'))->with('success', 'Your custom cake order, Request No. ' . $id . ' canceled.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showCheckoutForm($id)
    {
        $user = Auth::user();
        $customOrderId = $id;

        $token = session('payment_token');

        if (!$token) {
            // Generate and store the token in the session
            $token = Str::random(32);
            session(['custom_payment_token' => $token]);
        }

        $orders = DB::table('customize_orders')
            ->select('*')
            ->where('customize_orders.orderID', $id)
            ->get();

        $address = $orders->first()->address;
        $shipping_method = $orders->first()->shipping_method;

        // Initialize variables
        $location = null;
        $town = null;
        $province = null;
        $postalcode = null; 

        

        if ($address) {
            $addressParts = explode('||', $address);

            // Trim spaces from the parts
            $addressParts = array_map('trim', $addressParts);
            
            
            

            // Ensure there are at least three parts (location, town, and province)
            if (count($addressParts) >= 3) {
                $location = $addressParts[0];
                $town = $addressParts[1];
                $province = $addressParts[2];

                // Check if postal code exists (fourth part)
                if (count($addressParts) >= 4) {
                    $postalcode = $addressParts[3];
                }
            }
        }


        return view('checkout.custom-checkout')->with([
            'user' => $user,
            'orders' => $orders,
            'customOrderId' => $customOrderId,
            'location' => $location,
            'town' => $town,
            'province' => $province,
            'postalcode' => $postalcode,
            'shipping_method' => $shipping_method,
            'token' => $token,
        ]);
    }


    public function showBalanceCheckoutForm($id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $customOrderId = $id;

        $checkBalance = CustomizeOrderDetail::join('customize_orders', 'customize_order_details.customOrder_id', '=', 'customize_orders.id')
        ->where('customize_orders.orderID', $id)
        ->where('customize_order_details.user_id', $user_id)
        ->where('customize_order_details.payment_option', 'Half-online')
        ->where('customize_order_details.payment_balance', '>', 0)
        ->exists();

        if($checkBalance){
        

            $token = session('payment_token');

            if (!$token) {
                // Generate and store the token in the session
                $token = Str::random(32);
                session(['balance_payment_token' => $token]);
            }

            $orders =  CustomizeOrder::with('CustomizeOrderDetail')
                        ->where('customize_orders.orderID', $id)
                        ->get();

            return view('checkout.custom-checkout-balance')->with([
                'user' => $user,
                'orders' => $orders,
                'customOrderId' => $customOrderId,
                'token' => $token,
            ]);
        }else{
            return redirect()->route('redirect');
        }
    }

    public function customCheckout(Request $request, $id)
    {
        return redirect()->route('cake-request.checkout', ['id' => $id]);
    }

    public function customBalanceCheckout(Request $request, $id)
    {
        return redirect()->route('payment-balance.checkout', ['id' => $id]);
    }

}
