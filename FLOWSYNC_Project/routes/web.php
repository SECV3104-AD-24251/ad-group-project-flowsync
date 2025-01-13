<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LectEventController;


// Public routes
Route::view('/', 'welcome');
//Route::view('/calendar', 'calendar');
Route::view('/solution', 'solution');
Route::view('/helpCenter', 'helpCenter');
Route::view('/HC1', 'HC1');
Route::view('/student-timetable', 'stud_timetable');
Route::view('/student-calendar', 'fullcalendar');
Route::view('/lecturer-calendar', 'lect_calendar');


Route::get('/timetable', [TimetableController::class, 'showTimetable']);
Route::post('/timetable/add', [TimetableController::class, 'addTimetableEntry']);
//Route::delete('/timetable/delete', [TimetableController::class, 'deleteTimeEntry']);
// Route for storing timetable entries
//Route::post('/timetable/store', [TimetableController::class, 'storeTimetableEntry']);
Route::post('/timetable/store', [TimetableController::class, 'storeTimetable']);
Route::get('/timetable/show', [TimetableController::class, 'showTimetable']);
Route::get('/timetable/get', [TimetableController::class, 'getTimetableEntries']);  // New route to fetch timetable data
Route::get('/timetable', [TimetableController::class, 'showTimetable']);  // For rendering the timetable page
//Route::post('/timetable/store', [TimetableController::class, 'storeTimetable']);  // For storing timetable data
//Route::delete('/timetable/{id}/delete', [TimetableController::class, 'delete']);
Route::delete('/timetable/delete', [TimetableController::class, 'deleteEntry'])->name('timetable.delete');


Route::get('/stud-timetable', [TimetableController::class, 'showTimetable'])->name('stud_timetable');

//fullcalendar
Route::get('/events', [EventController::class, 'index']); // Fetch events
Route::post('/events', [EventController::class, 'store']); // Add new event
Route::put('/events/{id}', [EventController::class, 'update']); // Update an event
Route::delete('/events/{id}', [EventController::class, 'destroy']); // Delete an event
Route::get('/stud-calendar', function () {
    return view('fullcalendar');
});
Route::post('/events', [EventController::class, 'store']);
Route::get('/events', [EventController::class, 'index']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);
Route::post('/events', [EventController::class, 'store']);
Route::delete('/events/{event}', [EventController::class, 'destroy']);
Route::resource('events', EventController::class);
Route::post('/events', [EventController::class, 'store']);

//lecturer calendar
Route::get('/lect_event', [LectEventController::class, 'index']); // Fetch events
Route::post('/lect_event', [LectEventController::class, 'store']); // Add new event
Route::put('/lect_event/{id}', [LectEventController::class, 'update']); // Update an event
Route::delete('/lect_event/{id}', [LectEventController::class, 'destroy']); // Delete an event
Route::get('/lect-calendar', function () {
    return view('lect_calendar');
});
Route::post('/lect_event', [LectEventController::class, 'store']);
Route::get('/lect_event', [LectEventController::class, 'index']);
Route::delete('/lect_event/{id}', [LectEventController::class, 'destroy']);
Route::post('/lect_event', [LectEventController::class, 'store']);
Route::delete('/lect_event/{event}', [LectEventController::class, 'destroy']);
Route::resource('lect_event', LectEventController::class);
Route::post('/lect_event', [LectEventController::class, 'store']);

// Timetable routes
Route::get('/timetable', [TimetableController::class, 'showTimetable'])->name('timetable');
Route::get('/detect-clashes', [TimetableController::class, 'detectClashes'])->name('detect.clashes');

// Login page route
Route::get('/login', function () {
    return view('login');
})->name('login');

// Handle login form submission
Route::post('/login', function (Request $request) {
    $username = $request->input('user');
    $password = $request->input('pass');

    // Authentication logic
    if ($username === 'admin' && $password === 'admin') {
        $request->session()->put('user', $username); // Store user in session
        return redirect('/dashboard')->with('message', 'Admin Login Successful');
    } elseif ($username === 'A12CS3456' && $password === 'student') {
        $request->session()->put('user', $username); // Store user in session
        return redirect('/student-dashboard')->with('message', 'Student Login Successful');
    } elseif ($username === 'lecturer' && $password === 'lecturer') {
        $request->session()->put('user', $username); // Store user in session
        return redirect('/lecturer-dashboard')->with('message', 'Lecturer Login Successful');
    } else {
        return back()->with('error', 'Invalid Credentials');
    }
});

// Dashboard (protected)
Route::get('/dashboard', function () {
    if (session('user')) {
        return view('dashboard');
    }
    return redirect('/login')->with('error', 'Please login first.');
})->name('dashboard');


// Student Dashboard (protected)
Route::get('/student-dashboard', function () {
    if (session('user') === 'A12CS3456') {
        return view('stud_dashboard');
    }
    return redirect('/login')->with('error', 'Please login first.');
})->name('stud_dashboard');

// Student Dashboard (protected)
Route::get('/lecturer-dashboard', function () {
    if (session('user') === 'lecturer') {
        return view('lect_dashboard');
    }
    return redirect('/login')->with('error', 'Please login first.');
})->name('lect_dashboard');

// Logout
Route::post('/logout', function (Request $request) {
    $request->session()->forget('user'); // Remove session data
    return redirect('/login')->with('message', 'You have been logged out.');
})->name('logout');

// API integration: Generate solution from OpenAI
Route::post('/generate-solution', [SolutionController::class, 'detectClashes']);

// Timetable management
Route::get('/timetable/dropdown-data', [TimetableController::class, 'getDropdownData']);
Route::post('/timetable/add', [TimetableController::class, 'storeTimetableEntry']);
Route::post('/timetable/delete', [TimetableController::class, 'delete']);

// Google Calendar integration
Route::get('/google-calendar/auth', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/google-calendar/callback', [GoogleCalendarController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/google-calendar/events', [GoogleCalendarController::class, 'listEvents'])->name('google.events');
Route::get('google/calendar', [GoogleCalendarController::class, 'showGoogleCalendar'])->name('google.calendar');
Route::get('google/redirect', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.calendar.auth');
Route::get('google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);
Route::post('google/create-event', [GoogleCalendarController::class, 'createEvent'])->name('google.create.event');

// API for event management
Route::get('/api/events', [EventController::class, 'index']);
Route::post('/api/events', [EventController::class, 'store']);
Route::put('/api/events/{id}', [EventController::class, 'update']);
Route::delete('/api/events/{id}', [EventController::class, 'destroy']);
Route::post('/api/openai', [OpenAIController::class, 'handleRequest']);

// Google Authentication Routes
Route::get('google/auth', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.calendar.auth');
Route::get('google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);

// Detect clashes
Route::get('/detect-clashes', [TimetableController::class, 'detectClashes']);

Route::get('/fullcalendar', [FullCalendarController::class, 'index'])->name('fullcalendar');
Route::get('/fullcalendar-events', [FullCalendarController::class, 'fetchEvents'])->name('fullcalendar.events');
Route::post('/fullcalendar-events', [FullCalendarController::class, 'storeEvent'])->name('fullcalendar.store');
Route::get('/free-slots', [FullCalendarController::class, 'getFreeSlots'])->name('free.slots');

Route::get('/calendar', [FullCalendarController::class, 'index']);
Route::get('/events', [FullCalendarController::class, 'fetchEvents']);
Route::post('/events', [FullCalendarController::class, 'storeEvent']);
Route::put('/events/{id}', [FullCalendarController::class, 'updateEvent']);
Route::delete('/events/{id}', [FullCalendarController::class, 'deleteEvent']);
