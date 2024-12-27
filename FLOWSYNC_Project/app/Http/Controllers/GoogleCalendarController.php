<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GoogleCalendarController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
    }

    // Step 5: Redirect to Google OAuth for Authentication
    public function redirectToGoogle()
    {
        $authUrl = $this->client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    // Step 6: Handle the Google OAuth Callback
    public function handleGoogleCallback(Request $request)
    {
        $code = $request->get('code');
        if (empty($code)) {
            return redirect()->route('google.calendar');
        }

        $this->client->authenticate($code);
        Session::put('google_access_token', $this->client->getAccessToken());

        return redirect()->route('google.calendar');
    }

    // Step 7: Create Event in Google Calendar
    public function createEvent(Request $request)
    {
        $accessToken = Session::get('google_access_token');
        if ($accessToken) {
            $this->client->setAccessToken($accessToken);
        }

        if ($this->client->isAccessTokenExpired()) {
            return redirect()->route('google.calendar.auth');
        }

        $service = new Google_Service_Calendar($this->client);

        // Event details
        $event = new Google_Service_Calendar_Event([
            'summary' => $request->input('event_title'),
            'description' => $request->input('event_description'),
            'start' => new Google_Service_Calendar_EventDateTime([
                'dateTime' => $request->input('start_time'),
                'timeZone' => 'Asia/Kuala_Lumpur',
            ]),
            'end' => new Google_Service_Calendar_EventDateTime([
                'dateTime' => $request->input('end_time'),
                'timeZone' => 'Asia/Kuala_Lumpur',
            ]),
        ]);

        $calendarId = 'primary';
        $event = $service->events->insert($calendarId, $event);

        return redirect()->route('google.calendar')->with('success', 'Event created successfully!');
    }
}