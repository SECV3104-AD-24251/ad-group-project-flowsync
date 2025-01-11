<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
    {
        // Return all events in JSON format
        return response()->json(Event::all());
    }

    public function store(Request $request)
    {
        Log::info('Request data: ', $request->all());

        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // Create the new event
        try {
            $event = Event::create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
                'description' => $request->description,
            ]);

            return response()->json($event, 201);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create event'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // Update the event
        $event->update([
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return response()->json($event);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
