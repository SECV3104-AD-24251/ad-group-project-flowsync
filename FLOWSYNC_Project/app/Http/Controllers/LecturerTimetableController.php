<?php

namespace App\Http\Controllers;

use App\Models\LecturerTimetable;
use App\Models\StudentTimetable;

use Illuminate\Http\Request;

class LecturerTimetableController extends Controller
{
    /**
     * Display a listing of the timetables.
     */
    public function index()
    {
        // Fetch lecturer timetable
        $timetable = LecturerTimetable::orderBy('day')
            ->orderBy('time')
            ->get()
            ->groupBy('day');

        // Fetch student timetable
        $studentSchedule = StudentTimetable::orderBy('day')
            ->orderBy('time')
            ->get()
            ->groupBy('day');

        // Fetch unique time slots for table headers
        $timeSlots = LecturerTimetable::select('time')
            ->distinct()
            ->orderBy('time')
            ->get()
            ->pluck('time')
            ->toArray();

        // Predefined list of days
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // Pass data to the Blade view
        return view('lect_timetable', compact('timetable', 'studentSchedule', 'timeSlots', 'days'));
    }


    /**
     * Fetch the shared student timetable.
     */
    public function fetchSharedTimetable()
    {
        // Fetch student schedule grouped by day
        $studentSchedule = StudentTimetable::orderBy('day')
            ->orderBy('time')
            ->get()
            ->groupBy('day');

        // Define available days and time slots
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timeSlots = ['08:00 AM', '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM'];

        // Pass data to the Blade view
        return view('lect_timetable', compact('studentSchedule', 'days', 'timeSlots'));
    }

    /**
     * Store a newly created timetable in storage.
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
        LecturerTimetable::create($validated);

        // Redirect back to the timetable page with success message
        return redirect()->back()->with('success', 'Timetable entry added successfully!');
    }
    public function updateTimetable(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'time' => 'required',
            'slot' => 'required|integer|min:2|max:9',
        ]);
    
        // Find the timetable entry by subject, time, and slot or use unique identifier
        $entry = LecturerTimetable::where('subject', $request->subject)
            ->where('time', $request->time)
            ->where('slot', $request->slot)
            ->first();
    
        if ($entry) {
            // Update the timetable entry
            $entry->subject = $request->subject;
            $entry->time = $request->time;
            $entry->slot = $request->slot;
            $entry->save();
    
            // Return success response
            return response()->json(['success' => true]);
        } else {
            // Return error if entry not found
            return response()->json(['error' => 'Timetable entry not found'], 404);
        }
    }
    
    /**
     * Generate a copy of the timetable as a downloadable JSON file.
     */
    public function generateCopy()
    {
        // Fetch the timetable data grouped by day
        $timetable = LecturerTimetable::orderBy('day')
            ->orderBy('time')
            ->get()
            ->groupBy('day');

        // Prepare data for JSON
        $data = $timetable->map(function ($items, $day) {
            return [
                'day' => $day,
                'entries' => $items->map(function ($item) {
                    return [
                        'time' => $item->time,
                        'subject' => $item->subject,
                        'slot' => $item->slot,
                    ];
                })->toArray(),
            ];
        })->values();

        // Set file name and content
        $filename = 'lecturer_timetable.json';
        $content = json_encode($data, JSON_PRETTY_PRINT);

        // Return a streamed download response
        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $filename, ['Content-Type' => 'application/json']);
    }
}
