<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;

class GoogleCalendarService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(config('google.client_id'));
        $this->client->setClientSecret(config('google.client_secret'));
        $this->client->setRedirectUri(config('google.redirect_uri'));
        $this->client->addScope(config('google.scopes'));
    }

    public function authenticate($code)
    {
        return $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function setAccessToken($token)
    {
        $this->client->setAccessToken($token);
    }

    public function getCalendarService()
    {
        return new Google_Service_Calendar($this->client);
    }
}
