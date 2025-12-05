<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;   
use Illuminate\Support\Facades\Schema; 
use App\Models\Car;                   

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       
        try {
           
            if (Schema::hasTable('cars')) {
                $searchCars = Car::select('name', 'model_key')->get();
                View::share('globalSearchCars', $searchCars);
            }
        } catch (\Exception $e) {
           
        }
        
    }
}