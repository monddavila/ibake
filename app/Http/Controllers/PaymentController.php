<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;





class PaymentController extends Controller
{


    public function placeOrder(Request $request)
    {
        $phoneValidationPattern = '/^(?:\+63|0)[1-9]\d{9}$/';
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'recipient_name' => 'required|string|max:100',
            'street_address' => 'required|string|max:50',
            'town' => 'required|string|max:50',
            'province' => 'required|string|max:50',
            'postcode' => 'required|string|max:10',
            'recipient_email' => 'required|email|max:50',
            'recipient_phone' => ['required', 'string', 'max:11', 'regex:' . $phoneValidationPattern],
            'shipping_method' => 'required|string|max:255',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required|date_format:H:i',
            'payment_method' => 'required|string|in:card,wallet,bank', // Valid payment methods
            'order_notes' => 'nullable|string|max:1500',
        ]);

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
            'street_address' => 'required|string|max:50',
            'town' => 'required|string|max:50',
            'province' => 'required|string|max:50',
            'postcode' => 'required|string|max:10',
            'recipient_email' => 'required|email|max:50',
            'recipient_phone' => ['required', 'string', 'max:11', 'regex:' . $phoneValidationPattern],
            'shipping_method' => 'required|string|max:255',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required|date_format:H:i',
            'payment_method' => 'required|string|in:card,wallet,bank', // Valid payment methods
            'order_notes' => 'nullable|string|max:1500',
        ]);

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
            'description' => 'Cake Item Order',
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

    public function custom_pay($id)
    {
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

        // Initialize an array to store line items
        $lineItems = [];

        foreach ($items as $item) {
            // Add each cart item as a line item
            $lineItems[] = [
                'currency' => 'PHP',
                'amount' => $item->cakePrice * 100,
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

    public function success()
    {
       //$sessionId = \Session::get('session_id');
       $sessionId = session('paymentSession_id');
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