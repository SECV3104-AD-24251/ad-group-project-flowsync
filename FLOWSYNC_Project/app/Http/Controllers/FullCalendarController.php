<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\GroupChecklist;
use App\Models\Checklist;
use App\Models\ParticipantsGroup;
use Carbon\Carbon;

class FullCalendarController extends Controller
{
    // Render FullCalendar view
    public function index()
    {
        return view('fullcalendar');
    }

    // Fetch events from the database
    public function fetchEvents(Request $request)
    {
        $events = Event::all();
        return response()->json($events);
    }

    // Store new events in the database
    public function storeEvent(Request $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'start' => Carbon::parse($request->start)->toDateTimeString(),  // Format date
            'end' => Carbon::parse($request->end)->toDateTimeString(),      // Format date
            'description' => $request->description,
            'location' => $request->location,
            'notification' => $request->notification,
        ]);
        return response()->json($event);
    }

    // Update event details
    public function updateEvent(Request $request, $id)
    {
        // Find the event by ID
        $event = Event::findOrFail($id);

        // Update event details with formatted dates
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start' => Carbon::parse($request->start)->toDateTimeString(),  // Format date
            'end' => Carbon::parse($request->end)->toDateTimeString(),      // Format date
            'location' => $request->location,
            'notification' => $request->notification,
        ]);

        // Return the updated event as a JSON response
        return response()->json($event);
    }

    // Delete an event
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }

    public function createGroup(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'checklist' => 'required|array',
            'checklist.*' => 'required|string', // Each task should be a string
            'participants' => 'required|array',
            'participants.*' => 'email',
        ]);

        // Begin a database transaction to ensure all inserts succeed or fail together
        DB::beginTransaction();

        try {
            // Create the new group checklist
            $group = GroupChecklist::create([
                'title' => $validatedData['title'],
            ]);

            // Insert checklist items into the 'checklists' table
            foreach ($validatedData['checklist'] as $task) {
                Checklist::create([
                    'taskname' => $task, // Ensure taskname exists in the input
                    'checked' => 0, // Default to false if not provided
                    'groupID' => $group->id, // Associate with the newly created group
                ]);
            }

            // Insert participants into the 'participants_group' table
            foreach ($validatedData['participants'] as $email) {
                ParticipantsGroup::create([
                    'email' => $email, // Email for the participant
                    'groupID' => $group->id, // Associate with the newly created group
                ]);
            }

            // Commit the transaction if everything succeeded
            DB::commit();

            // Return a JSON response to indicate success
            return response()->json([
                'success' => true,
                'message' => 'Group checklist created successfully!',
                'group' => $group,
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Return an error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to create group checklist. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Method to fetch groups
    public function getGroups()
    {
        $groups = GroupChecklist::all(); // Fetch all groups
        return response()->json(['groups' => $groups]);
    }

    // Method to get group details
    // public function groupDetails($id)
    // {
    //     $group = GroupChecklist::findOrFail($id); // Find the group by ID
    //     return response()->json(['group' => $group]);
    // }
    public function showGroupDetails($groupId)
    {
        // Fetch the group, checklist tasks, and participants by group ID
        $group = GroupChecklist::findOrFail($groupId);
        $checklist = Checklist::where('groupID', $groupId)->pluck('taskname'); // Assuming `task` is a column in `checklist`
        $participants = ParticipantsGroup::where('groupID', $groupId)->pluck('email'); // Assuming `email` is a column in `participants_group`

        // Return the data as JSON
        return response()->json([
            'group' => $group,
            'checklist' => $checklist,
            'participants' => $participants
        ]);
    }
}



