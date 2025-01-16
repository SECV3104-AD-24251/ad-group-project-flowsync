<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentTimetable; // Your existing model

class StudentTimetableController extends Controller
{
    /**
     * Display the timetable.
     */
    public function index()
    {
        // Fetch and group timetable data by 'day' and sort by 'time'
        $timetable = StudentTimetable::orderBy('time')
            ->get()
            ->groupBy('day');

        // Fetch unique time slots for table headers
        $timeSlots = StudentTimetable::select('time')
            ->distinct()
            ->orderBy('time')
            ->get()
            ->pluck('time')
            ->toArray();

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // Return the timetable view with data
        return view('stud_timetable', compact('timetable', 'timeSlots', 'days'));
    }

    /**
     * Store a new timetable entry.
     */
    public function store(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'day' => 'required|string',
            'time' => 'required', // Time must be a valid time format
            'subject' => 'required|string|max:255',
            'slot' => 'required|integer|min:2|max:9', // Slot must be between 2 and 9
        ]);

        // Insert the new record into the database
        StudentTimetable::create([
            'day' => $validated['day'],
            'time' => $validated['time'],
            'subject' => $validated['subject'],
            'slot' => $validated['slot'],
        ]);

        // Redirect back to the timetable page with success message
        return redirect()->back()->with('success', 'Timetable entry added successfully!');
    }
}
