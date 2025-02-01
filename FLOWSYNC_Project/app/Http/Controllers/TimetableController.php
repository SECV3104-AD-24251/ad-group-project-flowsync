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
    // Fetch all timetable data from the database, including the day, start time, and end time
    $timetables = Timetable::select('id', 'course_code', 'course_name', 'section', 'day', 'start_time', 'end_time')
        ->orderBy('day') // Order by day
        ->orderBy('start_time', 'asc') // Order by start time
        ->get();


    $clashes = []; // Array to store detected clashes


    // Iterate over the timetables to compare each entry with others
    foreach ($timetables as $current) {
        foreach ($timetables as $compare) {
            // Skip comparing the same entry
            if ($current->id === $compare->id) {
                continue;
            }


            // Check if the day and time slots overlap
            if (
                $current->day === $compare->day && // Same day
                $current->start_time < $compare->end_time && // Overlapping start time
                $current->end_time > $compare->start_time // Overlapping end time
            ) {
                // Ensure they are different subject codes (clash condition)
                if ($current->course_code !== $compare->course_code) {
                    // Group clashes by time slot and day
                    $key = "{$current->day} {$current->start_time}-{$current->end_time}";


                    // Store clash details
                    if (!isset($clashes[$key])) {
                        $clashes[$key] = [
                            'day' => $current->day,
                            'time_slot' => "{$current->start_time}-{$current->end_time}",
                            'clashes' => [],
                        ];
                    }


                    // Add both courses to the clash group
                    $clashes[$key]['clashes'][] = [
                        'course_code' => $current->course_code,
                        'course_name' => $current->course_name,
                        'section' => $current->section,
                    ];


                    $clashes[$key]['clashes'][] = [
                        'course_code' => $compare->course_code,
                        'course_name' => $compare->course_name,
                        'section' => $compare->section,
                    ];
                }
            }
        }
    }


    // Return the output as JSON
    return response()->json([
        'status' => 'success',
        'clashes_detected' => count($clashes), // Total number of clashes
        'clashes' => $clashes, // Clash details grouped by time slot
    ]);
}
    public function updateEntry(Request $request, $id)
{
    // Validate the incoming data
    $validated = $request->validate([
        'course_code' => 'required|string|max:10',
        'course_name' => 'required|string|max:255',
        'section' => 'required|string|max:10',
        'day' => 'required|string|max:10',
        'start_time' => 'required|string|regex:/^\d{2}:\d{2}$/',]);

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
        Log::error('Error deleting timetable entry: ' . $e->getMessage());
        return response()->json(['message' => 'Failed to delete entry'], 500);
    }

    public function bookSlot(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:3', // Assuming duration in hours
        ]);

        // Process the data (e.g., save to database)
        // Assuming you have a Timetable model to handle the database interaction
        $slot = new Timetable;
        $slot->subject = $validated['subject'];
        $slot->time = $validated['time'];
        $slot->duration = $validated['duration'];
        $slot->save();

        // Return a success response (this could be an alert or a redirect)
        return response()->json([
            'message' => 'Slot booked successfully!',
            'status' => 'success'
        ]);
    }
}

