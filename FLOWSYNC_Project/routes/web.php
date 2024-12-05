<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Public routes
Route::view('/', 'welcome');
Route::view('/timetable', 'timetable');
Route::view('/calendar', 'calendar');

Route::view('/CLIENTS', 'clients');
Route::view('/ABOUT', 'about');
Route::view('/CONTACT', 'contact');

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
