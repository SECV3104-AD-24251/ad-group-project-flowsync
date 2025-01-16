<?php
namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    // Fetch lecturers and timetable
    public function getLecturers()
    {
        $lecturers = Lecturer::all();
        $timetable = Lecturer::select('name', 'course_code', 'section', 'time_slot', 'id')->get();

        return response()->json([
            'lecturers' => $lecturers,
            'timetable' => $timetable
        ]);
    }

    // Add a new lecturer's timetable entry
    public function addLecturer(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'course_code' => 'required|string',
            'section' => 'required|string',
            'time_slot' => 'required|string'
        ]);

        $lecturer = new Lecturer;
        $lecturer->name = $request->name;
        $lecturer->course_code = $request->course_code;
        $lecturer->section = $request->section;
        $lecturer->time_slot = $request->time_slot;
        $lecturer->save();

        return response()->json(['success' => true]);
    }

    // Delete a timetable entry
    public function deleteLecturer($id)
    {
        $lecturer = Lecturer::find($id);
        if ($lecturer) {
            $lecturer->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}

