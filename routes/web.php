<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductsController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShopController;


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

/**
 * Customer side Pages.
 * Will modify this routes. can be included in controllers or use slugs in database
 * to check pages for better performance and process.
 * For the moment we will use this step to modify and update the web pages
 */

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/chef', [HomeController::class, 'chef'])->name('chef');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/customize', [HomeController::class, 'customize'])->name('customize');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/track', [HomeController::class, 'track'])->name('track');
Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

/**Admin Panel Pages **/
/*Display users page*/
Route::group(['prefix' => 'user'], function () {
  Route::get('/list', [AdminController::class, 'viewUsers'])->name('user.list');
  /*Display create user form*/
  Route::get('/add', [AdminController::class, 'showAddUsersForm'])->name('user.form');
  /*Post data from form to database- create new user*/
  Route::post('/add-user', [AdminController::class, 'addUser'])->name('user.add');
});

/**
 * Products Section in Admin Dashboard
 * AdminProductsController is for frontend
 * ProductsController is for backend
 */
Route::group(['prefix' => 'products'], function () {
  Route::get('/list', [AdminProductsController::class, 'viewProductsList'])->name('admin.viewProducts');
  Route::get('/add', [AdminProductsController::class, 'viewAddProducts'])->name('admin.viewAddProducts');
  Route::post('/add', [ProductsController::class, 'create'])->name('admin.addProducts');
  Route::delete('/remove/{id}', [ProductsController::class, 'destroy'])->name('admin.deleteProducts');
  Route::get('/search', [ProductsController::class, 'search'])->name('admin.searchProducts');
});


/**
 * Shop/Products Section in Customer side
 */
Route::group(['prefix' => 'shop'], function () {
  Route::get('/', [ShopController::class, 'index'])->name('shop');
  Route::post('/', [ShopController::class, 'index'])->name('shop');
  Route::get('/item/{id}', [ShopController::class, 'show'])->name('item');
});

/**
 * Cart Section in Customer side
 */
Route::group(['prefix' => 'cart'], function () {
  Route::middleware(['auth'])
    ->get('/', [CartsController::class, 'show'])
    ->name('showCart');
  Route::post('/add-to-cart', [CartsController::class, 'store'])
    ->name('addToCart');
  Route::middleware(['auth'])
    ->put('update-cart-quantity', [CartItemsController::class, 'updateQuantity'])
    ->name('updateCartQuantity');
  Route::middleware(['auth'])
    ->delete('/remove/{productId}/cart/{cartId}', [CartItemsController::class, 'destroy'])
    ->name('removeItem');
});


/**
 * Login and Register Routes
 */
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'create'])->name('register')->withoutMiddleware('auth');
// For storing new account to database
Route::post('/register', [LoginController::class, 'store'])->name('register.store');

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified'
])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');
});
