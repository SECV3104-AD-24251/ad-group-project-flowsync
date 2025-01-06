<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;  // Ensure you import the Timetable model

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
}
