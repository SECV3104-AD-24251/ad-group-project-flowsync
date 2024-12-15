<?php
namespace App\Http\Controllers;

use App\Models\TimetableManagement; // Ensure you have this model imported
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    // Method to show the timetable
    public function showTimetable()
    {
        // Fetch all records from the timetable_management table
        $timetable = TimetableManagement::all();

        // Pass the data to the Blade view
        return view('timetable', compact('timetable'));
    }
    public function getTimetable() {
        $timetable = DB::table('timetable')
            ->select('course_code', 'course_name', 'section', 'time_slot')
            ->distinct() // Ensures unique rows are fetched
            ->get();
    
        return view('timetable', compact('timetable'));
    }    
    // Method to detect clashes
    // Method to detect clashes
public function detectClashes()
{
    // Fetch all records from the TimetableManagement table
    $timetable = TimetableManagement::all();
    $clashes = [];

    if ($timetable->isEmpty()) {
        return response()->json(['message' => 'No timetable data available.'], 404);
    }

    // Convert to array for easier manipulation
    $timetableArray = $timetable->toArray();

    // Compare each record with others without repeating combinations
    foreach ($timetableArray as $i => $course1) {
        for ($j = $i + 1; $j < count($timetableArray); $j++) { // Avoid repeating combinations
            $course2 = $timetableArray[$j];

            // Check for time slot clash and different course codes (subjects)
            if ($course1['time_slot'] === $course2['time_slot'] && 
                $course1['course_code'] !== $course2['course_code']) {
                
                // Add the clash details
                $clashes[] = [
                    'course1' => [
                        'course_code' => $course1['course_code'],
                        'course_name' => $course1['course_name'],
                        'section' => $course1['section'],
                        'lecturer_name' => $course1['lecturer_name']
                    ],
                    'course2' => [
                        'course_code' => $course2['course_code'],
                        'course_name' => $course2['course_name'],
                        'section' => $course2['section'],
                        'lecturer_name' => $course2['lecturer_name']
                    ],
                    'time_slot' => $course1['time_slot']
                ];
            }
        }
    }

    // Return clashes or a message if none are found
    if (empty($clashes)) {
        return response()->json(['message' => 'No clashes detected.'], 200);
    }

    return response()->json($clashes);
}
}