<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Contracts\Session\Session;

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
        view()->composer('page.header', function ($view) {
            $loai_sp = ProductType::all();
            $view->with('loai_sp', $loai_sp);
        });
        view()->composer('page.product_type', function ($view) {
            $product_new = Product::where('new', 1)->orderBy('id','DESC')->skip(1)->take(8)->get();
            $view->with('product_new', $product_new);
        });
        view()->composer('page.header', function($view) {
            if (Session('cart')) {
                $oldCart = Session()->get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart' => Session()->get('cart'),
                                        'product_cart' => $cart->items,
                                        'totalPrice' => $cart->totalPrice,
                                        'totalQty' => $cart ->totalQty
            ]);
            }
        });
    }
}
