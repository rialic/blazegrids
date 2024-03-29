<?php

namespace App\Providers;

use App\Proxy\Blaze\BlazeHeaders;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\URL;

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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        /**
         * Client HTTP Request do crash para ser utilizada no arquivo BlazeProxy
         */
        PendingRequest::macro('crash', function () {
            $blazeHeader = new BlazeHeaders();
            $crashUrl = config('app.crash_history_api');

            PendingRequest::retry(3, 3500)->withHeaders($blazeHeader->getCrashHeader())->get($crashUrl);
        });
    }
}
