@extends('layouts.app')     <!-- Extends the 'app' layout template -->

@section('content')     <!-- Section where content is injected into the 'app' layout -->
<div class="dashboard-container py-6 px-4 text-gray-800">
    <!-- Header Section -->
    <div class="text-center mb-16">
        <h1 class="text-5xl font-extrabold text-red-700 mb-4">Welcome Back, Student! 👋</h1>
        <p class="text-gray-600 text-lg">Seamlessly manage academic schedules and resources.</p>
    </div>

    <!-- Grid Container for Sections -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Timetable Section -->
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            <div class="mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Timetable</h2>
                <p class="text-gray-500 text-sm">3 SECVH - Semester 1 Session 2024/2025</p>
            </div>
            <a href="{{ route('stud_timetable') }}" 
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
            <a href="/calendar"
               class="w-full inline-block bg-red-500 text-white text-center py-2 rounded-lg font-medium hover:bg-red-600 transition">
                View Calendar
            </a>
        </div>
    </div>

    <!-- Additional Tips Section (Optional) -->
    <div class="mt-10 bg-red-50 p-6 rounded-xl border border-red-200 text-center">
        <h3 class="text-lg font-semibold text-red-600">Pro Tip</h3>
        <p class="text-gray-600 text-sm mt-2">Use the timetable and calendar to streamline your schedule efficiently!</p>
    </div>

</div>
@endsection
