<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Public routes
Route::view('/', 'welcome');
Route::view('/timetable', 'timetable');
Route::view('/calendar', 'calendar');
Route::view('/solution', 'solution');
Route::view('/helpCenter', 'helpCenter');
Route::view('/HC1', 'HC1');


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

// Solution page
Route::get('/solution', function () {
    return view('solution'); // Assumes you have a Blade view named 'solution.blade.php'
})->name('solution');

Route::get('/timetable', function () {
    return view('timetable');
})->name('timetable');


