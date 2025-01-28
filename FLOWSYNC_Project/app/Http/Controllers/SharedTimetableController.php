<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable; // Adjust the model namespace as needed

class SharedTimetableController extends Controller
{
    /**
     * Display the combined timetable for students and lecturers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all timetable data
        $allTimetable = Timetable::all();

        // Optionally, separate or filter data based on other attributes if needed
        // Example: Add your own conditions for grouping or displaying timetables

        // Pass the data to the view
        return view('sharedtimetable', [
            'combinedTimetable' => $allTimetable,
        ]);
    }

    /**
     * Handle additional shared timetable features, if any.
     */
    public function additionalFeature(Request $request)
    {
        // Example for handling additional features like exporting the timetable
    }
}
