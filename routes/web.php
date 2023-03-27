<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;




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

/*Route::get('/', function () {
    return view('home');
});
*/

route::get('/',[HomeController::class,'index']);

Route::get("/home",[HomeController::class,"index"]);
/* Route::get('/', 'IndexController@index'); */


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect',[HomeController::class,'redirect']);

/*Logout*/
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


 /**Will modify this routes , can be included in controllers or use slugs in database to check pages for better performance and process.
  For the moment we will use this step to modify and update the web pages
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
