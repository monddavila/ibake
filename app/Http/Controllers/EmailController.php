<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;


class EmailController extends Controller
{
    public function create()
    {
        return view('pages.contact');
    }

    public function sendEmail(Request $request)
    {
    $request->validate([
        'username' => 'required|string|max:20',
        'email' => 'required|email|max:50',
        'message' => 'required|string|max:500',
    ]);

    // Generate the date and time
    $dateTime = now()->format('Y-m-d H:i:s');

    $data = [
        'username' => $request->input('username'),
        'email' => $request->input('email'),
        'message' => $request->input('message'),
        'dateTime' => $dateTime,
    ];

        //dd($data);
    try {
        // Attempt to send the email
        Mail::to('teammed.amauonline@gmail.com')->send(new ContactFormMail($data));

        // Email sent successfully
        return redirect()->back()->with('success', 'Your message has been sent.');
        } catch (\Exception $e) {
        // Email sending failed
        return redirect()->back()->with('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }

}
