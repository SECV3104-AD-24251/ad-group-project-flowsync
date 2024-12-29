<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\GoogleCalendarController;

// Public routes
Route::view('/', 'welcome');
Route::view('/calendar', 'calendar');
Route::view('/solution', 'solution');
Route::view('/helpCenter', 'helpCenter');
Route::view('/HC1', 'HC1');

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

    if ($username === 'admin' && $password === 'admin') {
        $request->session()->put('user', $username); // Store user in session
        return redirect('/dashboard')->with('message', 'Login Successful');
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

// Google Authentication Routes
Route::get('google/auth', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.calendar.auth');
Route::get('google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);
