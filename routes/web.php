<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;

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
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// About Us page
Route::get('/about_us', [AboutUsController::class, 'index'])->name('about_us');

// About Us page
Route::get('/portfolio', [PortfolioController::class, 'portfolio'])->name('portfolio');

// Login
Route::get('/login', [LoginController::class, 'login'])->name('login');

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Register page
Route::get('/register', [RegisterController::class, 'create'])->name('register')->withoutMiddleware('auth');

// For storing new account to database
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
