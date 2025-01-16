<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LectEvent;

class LectEventController extends Controller
{
    public function index()
    {
        // Return all events in JSON format
        return response()->json(LectEvent::all());
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'notification' => 'nullable|string|in:none,5,10,15,30,60',
        ]);

        // Create the event
        $event = LectEvent::create($validatedData);

        return response()->json($event, 201); // Return created event with HTTP 201 status
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'notification' => 'nullable|string|in:none,5,10,15,30,60',
        ]);

        // Find the event and update it
        $event = LectEvent::findOrFail($id);
        $event->update($validatedData);

        return response()->json($event, 200); // Return updated event with HTTP 200 status
    }

    public function destroy($id)
    {
        // Find the event and delete it
        $event = LectEvent::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}
