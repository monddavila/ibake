<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Us page
Route::get('/about_us', [AboutUsController::class, 'index'])->name('about_us');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
// Login
Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'create'])->name('register')->withoutMiddleware('auth');
// Submit registration form
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified'
])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');
});
