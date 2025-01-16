<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentTimetable; // Your existing model

class StudentTimetableController extends Controller
{
    public function storeTimetable(Request $request)
    {
        $validatedData = $request->validate([
            'lecturer_name' => 'required|string',
            'course_name' => 'required|string',
            'section' => 'required|string',
            'time_slot' => 'required|string',
            'room' => 'required|string',
        ]);

        try {
            DB::table('lect_timetable')->insert([
                'lecturer_name' => $validatedData['lecturer_name'],
                'course_name' => $validatedData['course_name'],
                'section' => $validatedData['section'],
                'time_slot' => $validatedData['time_slot'],
                'room' => $validatedData['room'],
            ]);

            return response()->json(['success' => true, 'message' => 'Timetable entry added successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to add timetable entry.']);
        }
    }

}
