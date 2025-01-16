<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentTimetable;

class StudentTimetableController extends Controller
{
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

}
