<?php
namespace App\Http\Controllers;

use App\Models\TimetableManagement;
use App\Models\Course;
use App\Models\Section;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function getDropdownData()
    {
        return response()->json([
            'courses' => Course::all(),
            'sections' => Section::all(),
            'time_slots' => TimeSlot::all(),
        ]);
    }

    public function storeTimetableEntry(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required',
            'course_name' => 'required',
            'section' => 'required',
            'time_slot' => 'required',
        ]);

        return response()->json(['message' => 'Timetable entry added successfully!', 'entry' => $validated]);
    }

    public function showTimetable()
    {
        $timetable = TimetableManagement::all();
        return view('timetable', ['timetable' => $timetable]);
    }

    public function detectClashes()
    {
        $timetable = TimetableManagement::all();
        $clashes = [];
        $uniqueClashes = [];

        if ($timetable->isEmpty()) {
            return response()->json(['message' => 'No timetable data available.'], 404);
        }

        $timetableArray = $timetable->toArray();

        foreach ($timetableArray as $i => $course1) {
            for ($j = $i + 1; $j < count($timetableArray); $j++) {
                $course2 = $timetableArray[$j];

                if ($course1['time_slot'] === $course2['time_slot'] && 
                    $course1['course_code'] !== $course2['course_code']) {

                    $uniqueKey = $course1['course_code'] . '-' . $course2['course_code'] . '-' . $course1['time_slot'];

                    if (!in_array($uniqueKey, $uniqueClashes)) {
                        $uniqueClashes[] = $uniqueKey;

                        $clashes[] = [
                            'course1' => [
                                'course_code' => $course1['course_code'],
                                'course_name' => $course1['course_name'],
                                'section' => $course1['section'],
                                'lecturer_name' => $course1['lecturer_name'] ?? 'N/A'
                            ],
                            'course2' => [
                                'course_code' => $course2['course_code'],
                                'course_name' => $course2['course_name'],
                                'section' => $course2['section'],
                                'lecturer_name' => $course2['lecturer_name'] ?? 'N/A'
                            ],
                            'time_slot' => $course1['time_slot']
                        ];
                    }
                }
            }
        }

        if (empty($clashes)) {
            return response()->json(['message' => 'No clashes detected.'], 200);
        }

        return response()->json($clashes);
    }
}
