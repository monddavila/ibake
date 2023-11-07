<?php
namespace App\Providers;
use Illuminate\Support\Facades\Auth;



//use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\CartsController;
use App\Models\Cart;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap(); // Enable Bootstrap pagination
    
        // Share data with partials.navbar view
        View::composer('partials.navbar', function ($view) {
            if (Auth::check()) {

                $cart = Cart::where('user_id', auth()->user()->id)->first();
                if (!$cart) {
                  $userId = auth()->user()->id;
                  $cart = Cart::create(['user_id' => $userId]);
                }

                $cartsController = new CartsController();
                $userCartItems = $cartsController->userCart();
                $userCartItemCount = count($userCartItems);
                $view->with('userCart', $userCartItems)->with('cartItemCount', $userCartItemCount);
            }
        });
    }
}
