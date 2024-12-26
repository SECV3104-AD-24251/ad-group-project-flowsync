@extends('layouts.app')     <!-- Extends the 'app' layout template -->

@section('content')     <!-- Section where content is injected into the 'app' layout -->
<div class="dashboard-container py-6 px-4 text-gray-800">
    <!-- Header Section -->

<!-- Welcome Back Section -->
<div class="mb-8">
        <div class="bg-gray-100 p-4 rounded shadow">

            <h1 class="text-xl font-semibold">Hi, WELCOME BACK! ✋</h1>  
        </div>
    </div>



    <!-- Timetable Section -->
    <div class="mb-8">
        <div class="bg-gray-100 p-4 rounded shadow">
            <!-- Timetable Title -->
            <h2 class="text-xl font-semibold">Timetable</h2>

            <!-- Timetable Description -->
            <p class="text-gray-600 text-sm">3 SECVH - Semester 1 Session 2024/2025</p>

            <!-- Button to navigate to Timetable Page -->
            <a href="{{ route('timetable') }}" class="mt-4 inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Go to Timetable</a>
        </div>
    </div>

    <!-- Calendar Section -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <!-- Calendar Title -->
            <h2 class="text-xl font-semibold">Calendar</h2>

            <!-- Button to create a New Event -->
            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">New Event</button>
        </div>
        
        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-2 text-center">
            <!-- Weekdays -->
            <div class="font-semibold">Mon</div>
            <div class="font-semibold">Tue</div>
            <div class="font-semibold">Wed</div>
            <div class="font-semibold">Thu</div>
            <div class="font-semibold">Fri</div>
            <div class="font-semibold">Sat</div>
            <div class="font-semibold">Sun</div>

            <!-- Calendar Dates -->
            @for ($i = 1; $i <= 31; $i++)       <!-- Loop to generate calendar days for 1 to 31 -->
                @if (in_array($i, [1, 9, 10, 13, 15, 18]))      <!-- Check if the date has an event -->
                    <!-- Highlighted Dates with Events -->
                    <div class="border p-2 bg-red-100 rounded text-red-600">
                        <!-- Date Number -->
                        <span class="block font-bold">{{ $i }}</span>

                        <!-- Event Label -->
                        <span class="text-xs">Event</span>
                    </div>
                @else       <!-- Regular Dates -->
                    <!-- Non-Event Dates -->
                    <div class="border p-2 rounded">{{ $i }}</div>
                @endif
            @endfor
        </div>
    </div>
</div>
@endsection
