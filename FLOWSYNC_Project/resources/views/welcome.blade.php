@extends('layouts.app')     <!-- Extends the 'app' layout template -->

@section('content')     <!-- Section where content is injected into the 'app' layout -->
<div class="dashboard-container py-6 px-4 text-gray-800">
    <!-- Header Section -->
    <div class="header-section mb-10 text-center">
        <h1 class="text-3xl font-bold text-red-500 mb-2">Welcome Back! 👋</h1>
        <p class="text-gray-600 text-lg">Let’s get started with your schedule!</p>
    </div>

    <!-- Grid Container for Sections -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Timetable Section -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <div class="mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Timetable</h2>
                <p class="text-gray-500 text-sm">3 SECVH - Semester 1 Session 2024/2025</p>
            </div>
            <a href="/login" 
               class="w-full inline-block bg-red-500 text-white text-center py-2 rounded-lg font-medium hover:bg-red-600 transition">
                View Timetable
            </a>
        </div>

        <!-- Calendar Section -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <div class="mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Calendar</h2>
                <p class="text-gray-500 text-sm">Keep track of your important dates.</p>
            </div>
            <a href="/login" 
               class="w-full inline-block bg-red-500 text-white text-center py-2 rounded-lg font-medium hover:bg-red-600 transition">
                View Calendar
            </a>
        </div>
    </div>

</div>
@endsection
