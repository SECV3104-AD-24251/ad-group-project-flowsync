<?php

namespace App\Http\Controllers;

use App\Models\EventHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function viewHistoryPage()
    {
        return view('student_history'); // Shows the full history page
    }

    public function getStudentCalendarHistory()
    {
        // Get history for the logged-in student's events
        $histories = EventHistory::with('events')
            ->whereHas('events', function ($query) {
                $query->where('user_id', Auth::id()); // Only show events owned by the student
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($histories);
    }
        public function getEventHistory()
    {
        $eventHistory = EventHistory::orderBy('created_at', 'desc')->get();  // Fetching history records
        return response()->json($eventHistory);  // Return as JSON
    }

}
