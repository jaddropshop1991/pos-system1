<?php

namespace App\Providers;

//-----------added by me-----------
use Illuminate\Support\Facades\Schema;
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
       /* if($this->app->environment('production')) {
    \URL::forceScheme('https');
}*/
         if(env('APP_ENV') !== 'production')
        {
            $url->forceSchema('https');
        }
        
        //---------added by me-----------
        Schema:: defaultStringLength(191);

    }
}
