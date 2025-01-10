<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class FullCalendarController extends Controller
{
    // Render FullCalendar view
    public function index()
    {
        return view('fullcalendar');
    }

    // Fetch events from the database
    public function fetchEvents(Request $request)
    {
        $events = Event::all();
        return response()->json($events);
    }

    // Store new events in the database
    public function storeEvent(Request $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return response()->json($event);
    }
}
