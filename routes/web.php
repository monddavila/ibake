<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductsController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartItemsController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\CustomizeController;
use App\Http\Controllers\CustomerController;

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
Route::get('/customize', [HomeController::class, 'customize'])->name('customize');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [HomeController::class, 'terms'])->name('terms');

Route::get('/track-order', [HomeController::class, 'track'])->name('track');
Route::post('/track-order', [HomeController::class, 'trackOrderId'])->name('trackOrderId');


Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');

Route::get('/gallery', [GalleryController::class, 'gallery'])->name('gallery');
Route::get('/portfolio', [GalleryController::class, 'portfolio'])->name('portfolio');

//Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/contact-us', [EmailController::class, 'create'])->name('contact');
Route::post('/contact', [EmailController::class, 'sendEmail'])->name('send.email');


/**
 * Admin Panel Pages
 * Users Section
 **/
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
  Route::get('/list', [AdminController::class, 'viewUsers'])->name('user.list');
  /*Display create user form*/
  Route::get('/add', [AdminController::class, 'showAddUsersForm'])->name('user.form');
  /*Edit user data*/
  Route::get('/edit-user/{id}', [AdminController::class, 'editUser'])->name('user.edit');
  Route::post('/update/{id}', [AdminController::class, 'updateUser'])->name('user.update');
  /*Delete User*/
  Route::get('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');
  /*Post data from form to database- create new user*/
  Route::post('/add-user', [AdminController::class, 'addUser'])->name('user.add');
  /*Search User Functiion*/
  Route::get('/search', [AdminController::class, 'searchUser'])->name('user.search');
});

/**
 * Products Section in Admin Dashboard
 */
Route::group(['prefix' => 'products', 'middleware' => ['auth']], function () {
  Route::get('/list', [ProductsController::class, 'index'])->name('admin.viewProducts');
  Route::get('/add', [ProductsController::class, 'create'])->name('admin.viewAddProducts');
  Route::post('/add', [ProductsController::class, 'store'])->name('admin.addProducts');
  Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('admin.viewEditProducts');
  Route::put('/edit/{id}', [ProductsController::class, 'update'])->name('admin.editProducts');
  Route::delete('/remove/{id}', [ProductsController::class, 'destroy'])->name('admin.deleteProducts');
  Route::get('/search', [ProductsController::class, 'search'])->name('admin.searchProducts');
  Route::get('/getImage', [ProductsController::class, 'getImage'])->name('admin.getImage');
/*Categories Section*/
  Route::get('/categories', [ProductsController::class, 'viewCategories'])->name('admin.viewCategories');
  Route::post('/add-category', [ProductsController::class, 'addCategories'])->name('addCategory');
  Route::get('/delete-category/{id}', [ProductsController::class, 'deleteCategories'])->name('deleteCategory');
  Route::patch('/update-category', [ProductsController::class, 'updateCategories'])->name('updateCategory');
  /*Categories Section*/
  Route::get('/tags', [ProductsController::class, 'viewTags'])->name('admin.viewTags');
  Route::post('/add-tags', [ProductsController::class, 'addTags'])->name('addTag');
  Route::get('/delete-tag/{id}', [ProductsController::class, 'deleteTags'])->name('deleteTag');
  Route::patch('/update-tag', [ProductsController::class, 'updateTags'])->name('updateTag');
/*Reviews Section*/
  Route::get('/reviews', [ProductsController::class, 'viewReviews'])->name('viewReview');
  Route::get('/get-reviews', [ProductsController::class, 'getReviews'])->name('getReviews');

});

/**
 * Customer side
 */
Route::group(['prefix' => 'customer'], function () {
  Route::middleware(['auth']) ->get('/', [CustomerController::class, 'index'])->name('customer');
  Route::middleware(['auth']) ->get('active-orders', [CustomerController::class, 'customerActiveOrders'])->name('customerActiveOrder');
  Route::middleware(['auth']) ->get('order-history', [CustomerController::class, 'customerCompletedOrders'])->name('customerCompletedOrder');

  Route::middleware(['auth']) ->get('account-profile', [CustomerController::class, 'viewCustomerAccount'])->name('viewCustomerAccount');
  Route::middleware(['auth']) ->post('update-account-profile/{id}', [CustomerController::class, 'updateCustomerAccount'])->name('updateCustomerAccount');

  Route::middleware(['auth']) ->get('change-password', [CustomerController::class, 'viewCustomerPassword'])->name('viewCustomerPassword');
  Route::middleware(['auth']) ->post('change-password', [CustomerController::class, 'updateCustomerPassword'])->name('updateCustomerPassword');
  
});


/**
 * Shop/Products Section in Customer side
 */
Route::group(['prefix' => 'shop'], function () {
  Route::get('/', [ShopController::class, 'index'])->name('shop');
  Route::get('/filterShop', [ShopController::class, 'filterShop'])->name('shop.filterShop');
  Route::post('/', [ShopController::class, 'index'])->name('shop');
  Route::get('/item/{id}', [ShopController::class, 'show'])->name('item');
  
});

Route::group(['prefix' => 'orders'], function () {
  Route::middleware(['auth']) ->get('/dashboard', [OrdersController::class, 'ordersDashboard']);
  Route::middleware(['auth']) ->get('/active', [OrdersController::class, 'activeOrders'])->name('activeOrders');
  Route::middleware(['auth']) ->get('/ongoing', [OrdersController::class, 'ongoingOrders'])->name('ongoingOrders');
  Route::middleware(['auth']) ->get('/ready', [OrdersController::class, 'readyOrders'])->name('readyOrders');
  Route::middleware(['auth']) ->get('/completed', [OrdersController::class, 'completedOrders'])->name('completedOrders');
  Route::middleware(['auth']) ->get('/cancelled', [OrdersController::class, 'cancelledOrders'])->name('cancelledOrders');


  /*Customize Approving Section*/
  Route::middleware(['auth']) ->get('/customize-order-section', [AdminController::class, '__viewCustomOrders'])->name('customOrders');
  Route::middleware(['auth']) ->post('/process-order/{id}', [AdminController::class, 'processOrder'])->name('processOrder');
  Route::middleware(['auth']) ->post('/approval-order/{id}', [AdminController::class, '__updateCustomerOrders'])->name('approvalOrder');
  Route::middleware(['auth']) ->post('/reject-order/{id}', [AdminController::class, '__updateCustomerRejectOrders'])->name('rejectOrder');

  Route::middleware(['auth']) ->post('/update-status/{id}', [AdminController::class, 'processOrderStatus'])->name('processOrderStatus');
  
  Route::middleware(['auth']) ->get('/search-order', [AdminController::class, 'SearchCustomOrders'])->name('searchOrders');
});

/**
 * Customize/Products Section in Customer side
 */
Route::group(['prefix' => 'custom-orders'], function () {
  Route::post('/', [CustomizeController::class, 'store'])->name('custom-orders');
  Route::post('/upload-order-photo', [CustomizeController::class, '___insertCustomOrderImage'])->name('customer.upload-order-photo');
});


/**
 * Cart Section in Customer side
 */
Route::group(['prefix' => 'cart'], function () {
  Route::middleware(['auth'])
    ->get('/', [CartsController::class, 'index'])
    ->name('showCart');
  Route::get('/userCartWidget', [CartsController::class, 'userCartWidget'])
    ->name('userCartWidget');
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
 * Regular Shop Checkout
 */
Route::group(['prefix' => 'checkout'], function () {
  Route::middleware(['auth'])
    ->get('/', [OrdersController::class, 'create'])
    ->name('checkout');
  Route::middleware(['auth'])
    ->get('/create-order', [OrdersController::class, 'store'])
    ->name('create-order');
});
/**
 * Customize Cake Request Checkout
 */
// GET route for displaying the checkout form
Route::middleware(['auth'])
    ->get('/cake-request/checkout/{id}', [CustomizeController::class, 'showCheckoutForm'])
    ->name('cake-request.checkout');

Route::middleware(['auth'])
    ->get('/payment-balance/checkout/{id}', [CustomizeController::class, 'showBalanceCheckoutForm'])
    ->name('payment-balance.checkout');

// POST route for processing the form submission
Route::middleware(['auth'])
    ->post('/cake-request/checkout/{id}', [CustomizeController::class, 'customCheckout'])
    ->name('cake-request.process');

Route::middleware(['auth'])
    ->post('/payment-balance/checkout/{id}', [CustomizeController::class, 'customBalanceCheckout'])
    ->name('payment-balance.process');

Route::middleware(['auth'])
    ->post('/cake-request/cancel/{id}', [CustomizeController::class, 'cancelOrderRequest'])
    ->name('cake-request.cancel');

Route::middleware(['auth'])
    ->get('/store-custom-order', [CustomizeController::class, 'storeCustomOrder'])
    ->name('storeCustomOrder');

    Route::middleware(['auth'])
    ->get('/update-custom-order-balance', [CustomizeController::class, 'updateCustomOrderBalance'])
    ->name('updateCustomOrderBalance');

/**
 * Login and Register Routes
 */
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/switch-user', [LoginController::class, 'switchUser'])->name('switch')->middleware('auth');
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


/**
 * Payment Gateway - Payment controller
 */
Route::middleware(['auth']) ->get('pay',[PaymentController::class,'pay'])->name('pay');
Route::middleware(['auth']) ->get('success',[PaymentController::class,'success']);

Route::get('link-pay',[PaymentController::class,'linkPay']);
Route::get('link-status/{linkid}',[PaymentController::class,'linkStatus']);


Route::get('refund',[PaymentController::class,'refund']);
Route::get('refund-status/{id}',[PaymentController::class,'refundStatus']);


Route::middleware(['auth']) ->post('place-order',[PaymentController::class,'placeOrder'])->name('placeOrder');
Route::middleware(['auth']) ->post('place-custom-order/{id}',[PaymentController::class,'placeCustomOrder'])->name('placeCustomOrder');
Route::middleware(['auth']) ->post('place-custom-order-balance/{id}',[PaymentController::class,'placeCustomOrderBalance'])->name('placeCustomOrderBalance');
Route::middleware(['auth']) ->get('pay-custom-order/{id}', [PaymentController::class, 'custom_pay'])->name('custompay');
Route::middleware(['auth']) ->get('pay-custom-order-balance/{id}', [PaymentController::class, 'customBalancePay'])->name('customBalancePay');
/**
 * SMS Gateway - SMS controller
 */
Route::get('sendSMS',[SMSController::class,'sendSMS'])->name('sendSMS');