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
        // Fetch all timetable data, sorted by day and time
        $timetable = LecturerTimetable::orderBy('day')
            ->orderBy('time')
            ->get()
            ->groupBy('day'); // Group the collection by 'day'

        // Fetch unique time slots for table headers
        $timeSlots = LecturerTimetable::select('time')
            ->distinct()
            ->orderBy('time')
            ->get()
            ->pluck('time')
            ->toArray();

        // Predefined list of days (to ensure order in the view)
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        // Pass data to the Blade view
        return view('lect_timetable', compact('timetable', 'timeSlots', 'days'));
    }

    /**
     * Fetch the shared student timetable.
     */
    public function fetchSharedTimetable()
    {
        // Fetch all student timetable entries
        $studentTimetable = StudentTimetable::orderBy('day')
            ->orderBy('time')
            ->get()
            ->groupBy('day'); // Group by day

        // Return as JSON response (useful for AJAX)
        return response()->json($studentTimetable);
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
