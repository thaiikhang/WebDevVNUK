<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Typeproduct;
use Illuminate\Support\ServiceProvider;


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
        view()->composer('header',function($view) {
            $loai_sp = Typeproduct::all();
            $view->with('loai_sp', $loai_sp);
        });
        view()->composer('page.Typeproduct', function ($view) {
            $product_new = Product::where('new',1)->orderBy('id','DESC')->skip(1)->take(8)->get();
            $view-> with('product_new', $product_new);
        });
    }
}
