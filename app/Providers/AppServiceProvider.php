<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\NewDetail;

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
        Schema::defaultStringLength(191);
        $data['categories'] = Category::all();
        $data['products'] = Product::all();
        $data['accounts'] = Customer::all();
        $data['comments'] = ProductReview::all();
        $data['news'] = NewDetail::orderBy('created_at', 'DESC')->get();

        view()->share($data);
    }
}
