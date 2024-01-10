<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $block_numbers = ['A', 'B', 'C' , 'D'];
        $floor_numbers = ['1', '2', '3', '4', '5', '6', '8', '9', '10'];
        $flat_numbers = ['1', '2', '3', '4', '5', '6', '8', '9', '10'];

        View::share('block_numbers', $block_numbers);
        View::share('floor_numbers', $floor_numbers);
        View::share('flat_numbers', $flat_numbers);

    }
}
