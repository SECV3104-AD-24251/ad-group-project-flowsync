<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;

class SharedTimetableController extends Controller
{
    /**
     * Display the shared timetable form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $allTimetable = Timetable::all();
        return view('sharedtimetable', compact('allTimetable'));
    }

    /**
     * Store shared timetable data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'lecturer_name' => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'time_slot' => 'required|string',
            'room' => 'required|string',
        ]);

        Timetable::create([
            'lecturer_name' => $request->lecturer_name,
            'student_name' => $request->student_name,
            'time_slot' => $request->time_slot,
            'room' => $request->room,
        ]);

        return redirect()->route('sharedtimetable')->with('success', 'Timetable submitted successfully.');
    }
}
