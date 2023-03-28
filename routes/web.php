<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified'
])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');
});

route::get('/redirect', [HomeController::class, 'redirect']);

// Login
Route::get('/login', [LoginController::class, 'login'])->name('login');

// Register page
Route::get('/register', [LoginController::class, 'create'])->name('register')->withoutMiddleware('auth');
// For storing new account to database
Route::post('/register', [LoginController::class, 'store'])->name('register.store');


/**Will modify this routes , can be included in controllers or use slugs in database
 * to check pages for better performance and process.
 * For the moment we will use this step to modify and update the web pages
 **/
/*Contact Page */
Route::get('/contact', function () {
  return view('pages.contact');
})->name('contact');
/*About Page */
Route::get('/about', function () {
  return view('pages.about');
})->name('about');
/*Staff Page */
Route::get('/chef', function () {
  return view('pages.chef');
})->name('chef');
