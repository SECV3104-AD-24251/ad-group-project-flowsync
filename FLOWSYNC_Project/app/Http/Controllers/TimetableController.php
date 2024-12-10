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

    // Method to detect clashes
    public function detectClashes()
    {
        $timetable = TimetableManagement::all();
        $clashes = [];

        // Compare each record with every other record for clashes
        foreach ($timetable as $i => $course1) {
            foreach ($timetable as $j => $course2) {
                if ($i >= $j) {
                    continue;
                }

                // Check for time slot clash but different course codes (subjects)
                if ($course1->time_slot == $course2->time_slot && $course1->course_code != $course2->course_code) {
                    $clashes[] = [
                        'course1' => $course1->course_name,
                        'course2' => $course2->course_name,
                        'section1' => $course1->section,
                        'section2' => $course2->section,
                        'time_slot' => $course1->time_slot
                    ];
                }
            }
        }

        return response()->json($clashes);
    }
}
