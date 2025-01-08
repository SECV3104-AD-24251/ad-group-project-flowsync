<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;

class TimetableController extends Controller
{
    // Show the timetable page
    public function showTimetable()
    {
        // Fetch all timetables from the database
        $timetables = Timetable::all();

        // Return the timetable view with the timetables data
        return view('timetable', compact('timetables'));
    }

    // Store a new timetable entry
    public function storeTimetable(Request $request)
    {
        $request->validate([
            'course_code' => 'required',
            'course_name' => 'required',
            'section' => 'required',
            'time_slot' => 'required',
        ]);

        // Create a new timetable entry
        $timetable = new Timetable();
        $timetable->course_code = $request->course_code;
        $timetable->course_name = $request->course_name;
        $timetable->section = $request->section;
        $timetable->time_slot = $request->time_slot;
        $timetable->save();

        // Return a response to indicate success
        return response()->json(['message' => 'Timetable entry added successfully']);
    }

    // Fetch timetable entries as JSON for AJAX
    public function getTimetableEntries()
    {
        // Fetch all timetable entries from the database
        $timetables = Timetable::all();
        
        // Return the data as JSON
        return response()->json($timetables);
    }

    // Detect timetable clashes
    public function detectClashes()
    {
        // Fetch all timetable data from the database
        $timetables = Timetable::select('id', 'course_code', 'course_name as subject_name', 'section', 'day', 'start_time', 'end_time')
            ->orderBy('day') // Group by day
            ->orderBy('start_time', 'asc') // Order by time
            ->get();
    
        $clashes = []; // Array to store detected clashes
    
        // Compare each timetable entry with others
        foreach ($timetables as $current) {
            foreach ($timetables as $compare) {
                // Skip the same entry (avoid self-comparison)
                if ($current->id === $compare->id) {
                    continue;
                }
    
                // Check if the day and time slots overlap
                if (
                    $current->day === $compare->day && // Same day
                    $current->start_time < $compare->end_time && // Overlapping start time
                    $current->end_time > $compare->start_time // Overlapping end time
                ) {
                    // Ensure they are different subjects (clash condition)
                    if ($current->course_code !== $compare->course_code) {
                        // Store detected clash in a formatted way
                        $clashes[] = [
                            'subject_1' => "{$current->subject_name} ({$current->course_code}, Section {$current->section})",
                            'subject_2' => "{$compare->subject_name} ({$compare->course_code}, Section {$compare->section})",
                            'time_slot' => $current->start_time . '-' . $current->end_time,
                        ];
                    }
                }
            }
        }

        // Return the output as required
        return response()->json([
            'status' => 'success',
            'clashes_detected' => count($clashes), // Total clashes
            'clashes' => $clashes, // Raw clash output
        ]);
    }

    // Delete a timetable entry
public function deleteEntry(Request $request)
{
    // Log the incoming request data for debugging (optional)
    \Log::info('Received data:', $request->all());
    
    // Validate the incoming data
    $validated = $request->validate([
        'course_code' => 'required|string',
        'course_name' => 'required|string',
        'section' => 'required|string',
        'time_slot' => 'required|string',
    ]);
    
    try {
        // Find the timetable entry based on the incoming data
        $entry = Timetable::where([
            ['course_code', '=', $validated['course_code']],
            ['course_name', '=', $validated['course_name']],
            ['section', '=', $validated['section']],
            ['time_slot', '=', $validated['time_slot']]
        ])->first();
        
        // If entry exists, delete it
        if ($entry) {
            $entry->delete();
            return response()->json(['message' => 'Successfully deleted']);
        } else {
            return response()->json(['message' => 'Entry not found'], 404);
        }
    } catch (\Exception $e) {
        // Handle unexpected errors
        \Log::error('Error deleting timetable entry: ' . $e->getMessage());
        return response()->json(['message' => 'Failed to delete entry'], 500);
    }
}
}