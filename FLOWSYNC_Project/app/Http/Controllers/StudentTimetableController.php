<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentTimetable;

class StudentTimetableController extends Controller
{
    public function index()
    {
        // Fetch all timetable data and group by 'day'
        $timetable = StudentTimetable::all()->groupBy('day');
        
        // Return the timetable view with data
        return view('stud_timetable', compact('timetable'));
    }

}
