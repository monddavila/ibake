<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PendingUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function create()
  {
    return view('auth.register');
  }

  /**
   * Display the Login Page
   */
  public function login()
  {
    return view('auth.login');
  }

  /**
   * User log in method.
   * Created accounts are set to Admin as as now which will be redirected to
   * the dashboard.
   * 'usertype' value determines if the user is an admin or not.
   * usertype with a value of 0 is a Customer.
   * usertype with a value of 1 is an Admin.
   * Customers will be redirected to the homepage later in the development.
   * 
   */
  /*public function redirect()
  {
    if (
      !empty(Auth::user()) && Auth::user()->usertype == 1
    ) {
      return view('admin.home');
    }
    return redirect(route('home'));
  }*/

  /**
   * User log in method
   */
  public function logout(Request $request)
  {

    auth()->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('login');
  }

  public function switchUser()
  {
    dd('test');
      Auth::logout();
      return redirect()->route('login');
  }


  /**
   *  Store a newly created user in storage.
   */
    public function store(Request $request)
    {
      $phoneValidationPattern = '/^(?:\+63|0)[1-9]\d{9}$/';
  
      $validator = $request->validate([
          'firstname' => 'required|string|max:50',
          'lastname' => 'required|string|max:50',
          'email' => 'required|string|email|max:50|unique:users,email',
          'phone' => ['required', 'string', 'max:11', 'unique:users,phone', 'regex:' . $phoneValidationPattern],
          'address' => 'required|string|max:100',
          'password' => [
              'required',
              'string',
              'min:8',
              'max:16',
              'confirmed',
              'regex:/^(?=.*[a-z])(?=.*[A-Z])(?!.*\s).+$/',
          ],
      ], [
          'password.regex' => 'The password format is invalid. Please ensure it contains 8 characters and at least one uppercase letter, one lowercase letter, and no spaces.',
      ]);
  
      if ($validator) {

          Session::put('registration_data', $request->all());

          $token = Str::random(40);

          $user = PendingUser::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'token' => $token,
            'created_at' => now(),
        ]);


          Mail::send('emails.verify-account', ['token' => $token], function($message) use ($request){
            $message->to($request->email);
            $message->subject('Verify Your Email Address'); 

        });
    
          return redirect(route('showVerifyEmail'))->with([
            'success' => 'Registration details saved. Please check your email for verification.',
        ]);
      
      } else {
          // Handle the case where validation fails
          return redirect()->back()->withErrors($validator)->withInput();
      }
    }

    function showVerifyEmail(){

      // Retrieve all registration data from the session
      $email = Session::get('registration_data.email');


      return view('pages.verify-email', [
      'email' => $email,
    ]);
      
    }

    function activateAccount($token){

      $pendingUser = PendingUser::where('token', $token)->first();

        if(!$pendingUser){

          return redirect(route('register'));
      }

       // Check if the user with this email already exists in the users table
      $existingUser = User::where('email', $pendingUser->email)->first();

      if ($existingUser) {
        // User already exists, handle accordingly (e.g., redirect to login)
        return redirect(route('login'))->with('message', "Email already used by another account.");
      }
      
      
              // Create a new user record in the users table
        $newUser = User::create([
          'firstname' => $pendingUser->firstname,
          'lastname' => $pendingUser->lastname,
          'email' => $pendingUser->email,
          'password' => $pendingUser->password,
          'phone' => $pendingUser->phone,
          'address' => $pendingUser->address,
      ]);


        DB::table('pending_users')->where(['email' => $pendingUser->email])->delete();

        Auth::login($newUser);


        return redirect(route('redirect'));



    }


}
