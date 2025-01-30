<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventHistory;
use Barryvdh\DomPDF\Facade\Pdf;


class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);
    
        // Check for duplicate events (same title, start, and end)
        $duplicate = Event::where('title', $request->title)
                          ->where('start', $request->start)
                          ->where('end', $request->end)
                          ->exists();
    
        if ($duplicate) {
            return response()->json(['error' => 'This event already exists!'], 400);
        }
    
        // Check for overlapping events
        $conflict = Event::where(function ($query) use ($request) {
            $query->whereBetween('start', [$request->start, $request->end])
                  ->orWhereBetween('end', [$request->start, $request->end])
                  ->orWhere(function ($query) use ($request) {
                      $query->where('start', '<=', $request->start)
                            ->where('end', '>=', $request->end);
                  });
        })->exists();
    
        if ($conflict) {
            return response()->json(['error' => 'Event conflicts with an existing event!'], 400);
        }
    
        // Save the event if there are no duplicates or conflicts
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description ?? null,
            'location' => $request->location ?? null,
        ]);
    
        return response()->json($event, 201);
    }
                    
    public function update(Request $request, $id)
    {
        // Fetch the event from the "events" table
        $event = Event::findOrFail($id);
        
        // Get the old values before updating the event
        $oldValue = $event->getAttributes(); // This gives you the current event data
        
        // Update the event data
        $event->update([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
            'location' => $request->location,
            'notification' => $request->notification,
        ]);
        
        // Get the new values after updating the event
        $newValue = $event->getAttributes(); // This gives you the updated event data
        
        // Now we store the change in the "event_histories" table
        EventHistory::create([
            'event_id' => $event->id,
            'old_value' => json_encode($oldValue), // Store old values as JSON
            'new_value' => json_encode($newValue), // Store new values as JSON
            'updated_by' => auth()->user()->name, // Store who made the change
        ]);
        
        return response()->json(['success' => 'Event updated successfully!']);
    }
            
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(null, 204);
    }
    public function exportEvents()
    {
        $events = Event::all();
        $student_name = "Nur Ivy Maisarah"; // Replace with actual student name
        $student_matric = "A21CS1234"; // Replace with actual student ID
    
        $data = [
            'student_name' => $student_name,
            'student_matric' => $student_matric,
            'events' => $events
        ];
    
        $pdf = Pdf::loadView('events', $data);
    
        return $pdf->download('event_schedule.pdf');
    }
    
}