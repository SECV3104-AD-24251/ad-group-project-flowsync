<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GoogleCalendarController extends Controller
{
    public function authenticate()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(route('google.callback'));
        $client->addScope(Google_Service_Calendar::CALENDAR);

        // Generate the URL to authenticate
        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function callback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(route('google.callback'));

        $code = $request->get('code');
        $accessToken = $client->fetchAccessTokenWithAuthCode($code);

        // Store the access token in session
        Session::put('google_access_token', $accessToken);

        return redirect()->route('calendar.index');
    }

    public function getCalendarEvents()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setAccessToken(Session::get('google_access_token'));

        $service = new Google_Service_Calendar($client);
        $calendarId = 'primary';
        $events = $service->events->listEvents($calendarId);

        return view('calendar.index', ['events' => $events->getItems()]);
    }

    public function createEvent(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setAccessToken(Session::get('google_access_token'));

        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event([
            'summary' => $request->input('summary'),
            'start' => [
                'dateTime' => $request->input('start_time'),
                'timeZone' => 'Asia/Kuala_Lumpur',
            ],
            'end' => [
                'dateTime' => $request->input('end_time'),
                'timeZone' => 'Asia/Kuala_Lumpur',
            ],
        ]);

        $calendarId = 'primary';
        $service->events->insert($calendarId, $event);

        return redirect()->route('calendar.index')->with('success', 'Event created successfully!');
    }
}
