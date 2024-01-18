<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        // months 
        $months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        
        // years
        $start_year = 2022;
        $end_year = 2035;
        $years = [];
        for ($j = $start_year; $j <= $end_year; $j++) {
            $years[] = $j;
            
        }
        
        // floor
        $floor = 20;
        $floor_numbers = [];
        for ($j = 1; $j <= $floor; $j++) {
            $floor_numbers[] = $j;
        }
        
        // flat
        $flat = 15;
        $flat_numbers = [];
        for ($j = 1; $j <= $flat; $j++) {
            $flat_numbers[] = $j;
        }

        // blocks
        $block = 5;
        $block_no = 65 + $block;
        $block_numbers = [];
        for ($j = 65; $j < $block_no; $j++) {
          $block_numbers[] = chr($j);
        }
      

        // $floor_numbers = ['1', '2', '3', '4', '5', '6', '8', '9', '10', '11', '12', '13', '14', '15', '16', '18', '19', '20'];
        // $flat_numbers = ['1', '2', '3', '4', '5', '6', '8', '9', '10','11', '12', '13', '14', '15'];

        View::share('block_numbers', $block_numbers);
        View::share('floor_numbers', $floor_numbers);
        View::share('flat_numbers', $flat_numbers);
        View::share('months', $months);
        View::share('years', $years);

    }
}
