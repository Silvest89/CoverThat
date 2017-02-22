<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Youtube', function($app) {
            $client = new \Google_Client();
            $client->setAuthConfig(base_path('client_secrets.json'));
            $client->addScope(\Google_Service_Drive::DRIVE_METADATA_READONLY);
            $client->setRedirectUri('http://' . \Request::getHost() . '/oauth2callback.php');

            return $client;
        });
    }
}
