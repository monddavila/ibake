<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





class PaymentController extends Controller
{


    public function placeOrder(Request $request)
    {
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
                'success_url' => route('store'),
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
        //\Session::put('session_id',$response->data->id);
        session(['paymentSession_id' => $response->data->id]);

        

        return redirect()->to($response->data->attributes->checkout_url);

    }

    public function custom_pay($id)
    {
        $items = DB::table('customize_orders')
                    ->select('customize_orders.orderID', 'customize_orders.cakePrice')
                    ->where('customize_orders.orderID', $id)
                    ->get();;
        
        $totalPrice = 0;

        // Initialize an array to store line items
        $lineItems = [];

        foreach ($items as $item) {
            // Add each cart item as a line item
            $lineItems[] = [
                'currency' => 'PHP',
                'amount' => $item->cakePrice * 100,
                'description' => 'Cake Item Order',
                'name' => $id,
                'quantity' => 1,
            ];
        }

        $data = [
            'data' => [
                'attributes' => [
                    'line_items' => $lineItems, // Add the array of line items here
                    'payment_method_types' => [
                        'card', 'gcash', 'paymaya',
                    ],
                    'success_url' => route('home'),
                    'cancel_url' => route('checkout'),
                    'description' => 'iBake Tiers of Joy',
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

        // dd($response);
        //\Session::put('session_id',$response->data->id);
        session(['session_id' => $response->data->id]);

        return redirect()->to($response->data->attributes->checkout_url);
    }

    public function success()
    {
       //$sessionId = \Session::get('session_id');
       $sessionId = session('paymentSession_id');


      $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions/'.$sessionId)
                ->withHeader('accept: application/json')
                ->withHeader('Authorization: Basic '.env('AUTH_PAY'))
                ->asJson()
                ->get();

        dd($response);

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