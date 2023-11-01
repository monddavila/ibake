<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomizeOrder;





class PaymentController extends Controller
{


    public function placeOrder(Request $request)
    {
        //Validate ordered products qty should not exceed product qty available
        $cartItems = (new CartsController())->userCart();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->quantity > $cartItem->available_qty) {
                return back()->with('error', 'Quantity for item <strong>' . $cartItem->name . '</strong> exceeds its available quantity. Please adjust your cart.');

            }
        }

        $phoneValidationPattern = '/^(?:\+63|0)[1-9]\d{9}$/';
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'recipient_name' => 'required|string|max:100',
            'recipient_email' => 'required|email|max:50',
            'recipient_phone' => ['required', 'string', 'max:11', 'regex:' . $phoneValidationPattern],
            'shipping_method' => 'required|string|max:255',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required|date_format:H:i',
            'payment_method' => 'required|string|max:255',
            'order_notes' => 'nullable|string|max:1500',
        ], [
            'delivery_date.required' => 'The date field is required.',
        ]);
        
        // Conditional Validation
        $validator->sometimes('street_address', ['required', 'string', 'max:100'], function ($input) {
            return $input['shipping_method'] === 'Delivery';
        });
        
        $validator->sometimes('town', ['required', 'string', 'max:50'], function ($input) {
            return $input['shipping_method'] === 'Delivery';
        });
        
        $validator->sometimes('province', ['required', 'string', 'max:50'], function ($input) {
            return $input['shipping_method'] === 'Delivery';
        });
        
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        

        // Save the form data to a session variable
        $request->session()->put('order_data', $request->all());


        $paymentMethod = $request->input('payment_method');

        if (in_array($paymentMethod, ['card', 'wallet', 'bank'])) {
            // Valid payment method, set it in the session and redirect to 'pay'
            session(['payment_method' => $paymentMethod]);
            return redirect()->route('pay');
        } else {
            // Handle unsupported or unknown payment methods
            $result = ['success' => false, 'message' => 'Invalid payment method'];
        }
    }

    public function placeCustomOrder(Request $request, $id)
    {

        $phoneValidationPattern = '/^(?:\+63|0)[1-9]\d{9}$/';
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'recipient_name' => 'required|string|max:100',
            'recipient_email' => 'required|email|max:50',
            'recipient_phone' => ['required', 'string', 'max:11', 'regex:' . $phoneValidationPattern],
            'shipping_method' => 'required|string|max:255',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required|date_format:H:i',
            'payment_option' => 'required',
            'payment_method' => 'required|string|max:255',
            'order_notes' => 'nullable|string|max:1500',
        ], [
            'delivery_date.required' => 'The date field is required.',
        ]);
    
        // Conditional Validation
        $validator->sometimes('street_address', ['required', 'string', 'max:100'], function ($input) {
            return $input['shipping_method'] === 'Delivery';
        });
        
        $validator->sometimes('town', ['required', 'string', 'max:50'], function ($input) {
            return $input['shipping_method'] === 'Delivery';
        });
        
        $validator->sometimes('province', ['required', 'string', 'max:50'], function ($input) {
            return $input['shipping_method'] === 'Delivery';
        });
        
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        

        // Save the form data to a session variable
        $request->session()->put('customOrder_data', $request->all());


        $paymentMethod = $request->input('payment_method');

        if (in_array($paymentMethod, ['card', 'wallet', 'bank'])) {
            // Valid payment method, set it in the session and redirect to 'pay'
            session(['custom_payment_method' => $paymentMethod]);
            return redirect()->route('custompay', ['id' => $id]);
        } else {
            // Handle unsupported or unknown payment methods
            $result = ['success' => false, 'message' => 'Invalid payment method'];
        }
    }

    public function placeCustomOrderBalance(Request $request, $id)
    {
        $paymentMethod = $request->input('payment_method');

        if (in_array($paymentMethod, ['card', 'wallet', 'bank'])) {
            // Valid payment method, set it in the session and redirect to 'pay'
            session(['custom_balance_payment_method' => $paymentMethod]);
            return redirect()->route('customBalancePay', ['id' => $id]);
        } else {
            // Handle unsupported or unknown payment methods
            $result = ['success' => false, 'message' => 'Invalid payment method'];
        }
    }


    public function pay()
    {
    $user = Auth::user();
    $cartItems = (new CartsController())->userCart();
    $totalPrice = 0;

    // Initialize an array to store line items
    $lineItems = [];

    foreach ($cartItems as $cartItem) {
        // Calculate the total price
        $totalPrice += ($cartItem->price * $cartItem->quantity);

        // Add each cart item as a line item
        $lineItems[] = [
            'currency' => 'PHP',
            'amount' => $cartItem->price * 100, // Amount in cents
            'description' => 'Shop Item Order',
            'name' => $cartItem->name,
            'quantity' => $cartItem->quantity,
        ];
    }

    // Determine the payment method types based on the selected payment method
    $paymentType = session('payment_method');


    $paymentMethodTypes = [];

    if ($paymentType === 'card') {
        $paymentMethodTypes[] = 'card';
    } elseif ($paymentType === 'wallet') {
        $paymentMethodTypes = ['gcash', 'paymaya'];
    } elseif ($paymentType === 'bank') {
        $paymentMethodTypes[] = 'dob';
    } else {
        // Handle other cases or invalid selections here
        return redirect()->route('checkout')->with('error', 'Invalid payment method selected.');
    }

    $data = [
        'data' => [
            'attributes' => [
                'line_items' => $lineItems, // Add the array of line items here
                'payment_method_types' => $paymentMethodTypes,
                'success_url' => route('create-order'),
                'cancel_url' => route('checkout'),
                'description' => 'iBake Tiers of Joy',
                'send_email_receipt' => true,
            ],
        ],
    ];

    $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader('accept: application/json')
                    ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                    ->withData($data)
                    ->asJson()
                    ->post();


        // Store the session ID in the session
        session(['paymentSession_id' => $response->data->id]);
        // Store the payment intent ID in the session
        session(['paymentIntent_id' =>$response->data->attributes->payment_intent->id]);

        

        return redirect()->to($response->data->attributes->checkout_url);

    }

    public function custom_pay($id, Request $request)
    {

        $customOrderData = $request->session()->get('customOrder_data');
        $paymentOption = $customOrderData['payment_option'];



        $items = DB::table('customize_orders')
                    ->select('customize_orders.id','customize_orders.orderID', 'customize_orders.cakePrice')
                    ->where('customize_orders.orderID', $id)
                    ->get();

        $customOrder_id = $items[0]->id;
                    session(['customOrder_id' => $customOrder_id]);
        $customize_order_id = $id;
                    session(['customize_order_id' => $customize_order_id]);
        $cakePrice = $items[0]->cakePrice;
                    session(['cakePrice' => $cakePrice]);
        
        $name = 'Customize Cake Order ID - ' . $id;

        $description = 'iBake Tiers of Joy - Order ID: ' . $id;

        // Initialize an array to store line items
        $lineItems = [];
        //check payment if full or half
        if($paymentOption == 'Full'){
                $finalCakePrice = $cakePrice;
                session(['custom_cakeBal' => null]);
            }else{
                $finalCakePrice = ($cakePrice)/2;
                session(['custom_cakeBal' => $finalCakePrice]);
            }

        foreach ($items as $item) {
            // Add each cart item as a line item
            $lineItems[] = [
                'currency' => 'PHP',
                'amount' => $finalCakePrice * 100,
                'description' => 'Custom Cake Order',
                'name' => $name,
                'quantity' => 1,
            ];
        }

         // Determine the payment method types based on the selected payment method
            $paymentType = session('custom_payment_method');


            $paymentMethodTypes = [];

            if ($paymentType === 'card') {
                $paymentMethodTypes[] = 'card';
            } elseif ($paymentType === 'wallet') {
                $paymentMethodTypes = ['gcash', 'paymaya'];
            } elseif ($paymentType === 'bank') {
                $paymentMethodTypes[] = 'dob';
            } else {
                // Handle other cases or invalid selections here
                return redirect()->route('checkout')->with('error', 'Invalid payment method selected.');
            }

        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => $lineItems, // Add the array of line items here
                    'payment_method_types' => $paymentMethodTypes,
                    'success_url' => route('storeCustomOrder'),
                    'cancel_url' => route('cake-request.process', ['id' => $id]),
                    'description' => $description,
                    'send_email_receipt' => true,
                ],
            ],
        ];

       $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader('accept: application/json')
                    ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                    ->withData($data)
                    ->asJson()
                    ->post();

        // Store the session ID in the session
        session(['paymentSession_id' => $response->data->id]);
        // Store the payment intent ID in the session
        session(['paymentIntent_id' =>$response->data->attributes->payment_intent->id]);

        return redirect()->to($response->data->attributes->checkout_url);
    }

    public function customBalancePay($id, Request $request)
    {
        $order_id= $id;

        $order =  CustomizeOrder::with('CustomizeOrderDetail')
                    ->where('orderID', $order_id)
                    ->first();

        $paymentBalance = $order->CustomizeOrderDetail->payment_balance;
        $customOrder_id = $order->CustomizeOrderDetail->customOrder_id;

                    session(['customBalanceOrder_id' => $order_id]);
                    session(['customBalance_customizeOrder_id' => $customOrder_id]);
                    Session(['customBalance_payment' => $paymentBalance]);
                    
        $name = 'Order ID - ' . $id;

        $description = 'iBake Tiers of Joy - Payment Balance';

        // Initialize an array to store line items
        $lineItems = [];
       

            // Add each cart item as a line item
            $lineItems[] = [
                'currency' => 'PHP',
                'amount' => $paymentBalance * 100,
                'description' => $description,
                'name' => $name,
                'quantity' => 1,
            ];


         // Determine the payment method types based on the selected payment method
            $paymentType = session('custom_balance_payment_method');

            $paymentMethodTypes = [];

            if ($paymentType === 'card') {
                $paymentMethodTypes[] = 'card';
            } elseif ($paymentType === 'wallet') {
                $paymentMethodTypes = ['gcash', 'paymaya'];
            } elseif ($paymentType === 'bank') {
                $paymentMethodTypes[] = 'dob';
            } else {
                // Handle other cases or invalid selections here
                return redirect()->route('checkout')->with('error', 'Invalid payment method selected.');
            }

        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => $lineItems, // Add the array of line items here
                    'payment_method_types' => $paymentMethodTypes,
                    'success_url' => route('updateCustomOrderBalance'),
                    'cancel_url' => route('payment-balance.process', ['id' => $id]),
                    'description' => $description,
                    'send_email_receipt' => true,
                ],
            ],
        ];

       $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader('accept: application/json')
                    ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                    ->withData($data)
                    ->asJson()
                    ->post();

        // Store the payment intent ID in the session
        session(['BalancePaymentIntent_id' =>$response->data->attributes->payment_intent->id]);

        return redirect()->to($response->data->attributes->checkout_url);
    }

    public function success()
    {
       //$sessionId = \Session::get('session_id');
       $sessionId = session('paymentSession_id');

       //$sessionPaymentIntentId = 'pi_VAHEjoNVGkduhcNAYYKgCiBG';

       $sessionPaymentIntentId = session('paymentIntent_id');
       $sessionPaymentId = session('payment_id');

       $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions/'.$sessionId)
                ->withHeader('accept: application/json')
                ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                ->asJson()
                ->get(); 


       $paymentIntent = Curl::to('https://api.paymongo.com/v1/payment_intents/'.$sessionPaymentIntentId)
       ->withHeader('accept: application/json')
       ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
       ->asJson()
       ->get();

       $payment = Curl::to('https://api.paymongo.com/v1/payments/'.$sessionPaymentId)
        ->withHeader('accept: application/json')
        ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
        ->asJson()
        ->get();

        dd($paymentIntent);
        //dd($response->data->attributes->payment_intent->id); 
        //dd($response->data->attributes->payments[0]->id);
        //dd($response->data->attributes->payments[0]->id); //payment id
        //session(['paymentIntent_status' =>$response->data->attributes->payment_intent->attributes->status]);


    }



    public function linkPay()
    {
        $data['data']['attributes']['amount'] = 150050;
        $data['data']['attributes']['description'] = 'Test transaction.';

         $response = Curl::to('https://api.paymongo.com/v1/links')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader('accept: application/json')
                    ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                    ->withData($data)
                    ->asJson()
                    ->post();

        session(['session_id' => $response->data->id]);

        return redirect()->to($response->data->attributes->checkout_url);

        //dd($response);
    }

    public function linkStatus($linkid)
    {
         $response = Curl::to('https://api.paymongo.com/v1/links/'.$linkid)
                ->withHeader('accept: application/json')
                ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                ->asJson()
                ->get();


        session(['session_id' => $response->data->id]);

        //return redirect()->to($response->data->attributes->checkout_url);
        
        dd($response);
    }


    public function refund()
    {

        $data['data']['attributes']['amount']       = 5000;
        $data['data']['attributes']['payment_id']   = 'pay_sA83KrtmJUdue8prEHD6rZrY';
        $data['data']['attributes']['reason']       = 'duplicate';

         $response = Curl::to('https://api.paymongo.com/refunds')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader('accept: application/json')
                    ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                    ->withData($data)
                    ->asJson()
                    ->post();

        dd($response);
    }

    public function refundStatus($id)
    {
        $response = Curl::to('https://api.paymongo.com/refunds/'.$id)
                ->withHeader('accept: application/json')
                ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                ->asJson()
                ->get();

        dd($response);
    }
}