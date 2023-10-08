<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SMSController extends Controller
{
    public function sendSMS(Request $request)
    {
        // Retrieve recipient and message from the request
        //$recipient = $request->input('recipient');
        //$message = $request->input('message');
        $recipient = '639273782538';
        $message = 'Test Message';

        // Set your EngageSpark API Key and Org ID
        $apiKey = env('ENGAGE_SPARK_API_KEY'); //  API Key
        $orgId = env('ENGAGE_SPARK_ORG_ID'); // Org ID

        // Compose the SMS data
        $jsonData = [
            'orgId' => $orgId,
            'to' => $recipient,
            'message' => $message,
            'from' => 'iBake',
        ];

        // Create a Guzzle HTTP client
        $client = new Client();

        // Encode data as JSON
        $jsonDataEncoded = json_encode($jsonData);


        // Send the SMS using the EngageSpark API
        $response = $client->post('https://api.engagespark.com/v1/sms/phonenumber', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Token ' . $apiKey,
            ],
            'body' => $jsonDataEncoded,
        ]);

        dd($response);

        // Handle the API response (e.g., show success message or error handling)
        if ($response->getStatusCode() === 200) {
            return response()->json(['message' => 'SMS sent successfully']);
        } else {
            return response()->json(['error' => 'Failed to send SMS'], 400);
        }
    }
}
