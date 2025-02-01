<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Models\Event;

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

    public function showGoogleCalendar()
{
    return view('fullcalendar'); 
}


    // Redirect to Google OAuth for Authentication
    public function redirectToGoogle()
    {
        $authUrl = $this->client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        $code = $request->get('code');
        if (empty($code)) {
            return redirect()->route('google.calendar');
        }

        // Handle authentication and token storage
        $this->client->authenticate($code);
        $token = $this->client->getAccessToken();
        Session::put('google_access_token', $token['access_token']);
        if (isset($token['refresh_token'])) {
            Session::put('google_refresh_token', $token['refresh_token']);
        }

        return redirect()->route('google.calendar');
    }

    public function modifySchedule(Request $request)
    {
        // Example validation and handling
        $request->validate([
            'event_title' => 'required|string|max:255',
            'event_description' => 'nullable|string|max:500',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ]);

        // Call your method to create or update the event
        return $this->createOrUpdateEvent($request);
    }

    public function createOrUpdateEvent(Request $request)
    {
        $accessToken = Session::get('google_access_token');
        $refreshToken = Session::get('google_refresh_token');

        if (!$accessToken) {
            return redirect()->route('google.calendar.auth');
        }

        $this->client->setAccessToken($accessToken);

        // Refresh token if expired
        if ($this->client->isAccessTokenExpired()) {
            if ($refreshToken) {
                $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
                $newAccessToken = $this->client->getAccessToken();
                Session::put('google_access_token', $newAccessToken['access_token']);
            } else {
                return redirect()->route('google.calendar.auth');
            }
        }

        $service = new Google_Service_Calendar($this->client);

        // Check if event ID exists for updating or creating
        $eventId = $request->input('event_id');
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

        // Check if we need to update or insert the event
        try {
            if ($eventId) {
                // Update existing event
                $updatedEvent = $service->events->update($calendarId, $eventId, $event);
                return redirect()->route('google.calendar')->with('success', 'Event updated successfully!');
            } else {
                // Create a new event
                $event = $service->events->insert($calendarId, $event);
                return redirect()->route('google.calendar')->with('success', 'Event created successfully!');
            }
        } catch (\Exception $e) {
            // Handle error when creating or updating the event
            return redirect()->route('google.calendar')->with('error', 'Failed to create/update event: ' . $e->getMessage());
        }
    }

}