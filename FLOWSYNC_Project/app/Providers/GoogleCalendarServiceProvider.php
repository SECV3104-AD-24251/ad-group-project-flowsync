<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Client;
use Google\Service\Calendar;

class GoogleCalendarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path(config('services.google.calendar_credentials')));
        $client->addScope(Calendar::CALENDAR);

        // Bind Google Client as a singleton to the container
        $this->app->singleton(Client::class, function ($app) use ($client) {
            return $client;
        });

        // Bind Google Calendar service
        $this->app->singleton(Calendar::class, function ($app) {
            $client = $app->make(Client::class);
            return new Calendar($client);
        });
    }
}
