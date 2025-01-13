<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon; 

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
            'start' => Carbon::parse($request->start)->toDateTimeString(),  // Format date
            'end' => Carbon::parse($request->end)->toDateTimeString(),      // Format date
            'description' => $request->description,
            'location' => $request->location,
        ]);

        return response()->json($event);
    }

    // Update event details
    public function updateEvent(Request $request, $id)
    {
        // Find the event by ID
        $event = Event::findOrFail($id);

        // Update event details with formatted dates
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start' => Carbon::parse($request->start)->toDateTimeString(),  // Format date
            'end' => Carbon::parse($request->end)->toDateTimeString(),      // Format date
            'location' => $request->location,
        ]);

        // Return the updated event as a JSON response
        return response()->json($event);
    }

    // Delete an event
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
