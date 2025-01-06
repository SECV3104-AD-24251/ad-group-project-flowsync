@extends('layouts.app') <!-- Extends the 'app' layout template -->

@section('content') <!-- Section where content is injected into the 'app' layout -->
<div class="dashboard-container py-12 px-8 bg-gradient-to-r from-blue-50 via-white to-blue-50 min-h-screen relative">
    <!-- Header Section -->
    <div class="text-center mb-16">
        <h1 class="text-5xl font-extrabold text-blue-700 mb-4">Welcome Back, Admin! 👋</h1>
        <p class="text-gray-600 text-lg">Seamlessly manage academic schedules and resources.</p>
    </div>

    <!-- Faculty Calendar Button at Top Right -->
    <div class="absolute top-8 right-8">
        <a href="https://calendar.google.com/calendar/u/0/r?pli=1" 
           target="_blank" 
           class="block bg-red-500 text-white text-center py-2 px-6 rounded-lg font-medium hover:bg-red-600 transition shadow-md">
            View Calendar
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-16">
        <!-- Timetable Management -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:scale-105 border-t-4 border-red-500">
            <h2 class="text-lg font-semibold text-gray-700 mb-2 text-center">Timetable Management</h2>
            <p class="text-sm text-gray-500 text-center mb-4">3 SECVH - Semester 1 Session 2024/2025</p>
            <a href="{{ route('timetable') }}" class="block bg-blue-500 text-white text-center py-2 rounded-lg font-medium hover:bg-blue-600 transition">
                View Timetable
            </a>
        </div>

        <!-- Google Calendar -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:scale-105 border-t-4 border-red-500">
            <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Google Calendar</h2>
            <iframe src="https://calendar.google.com/calendar/embed?src=nurirdinasyafiqahab%40gmail.com&ctz=Asia%2FKuala_Lumpur"
                    class="w-full h-64 border-none rounded-lg" scrolling="no"></iframe>
        </div>
    </div>

    <!-- Interactive Map -->
    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:scale-105 border-t-4 border-red-500">
        <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Interactive Map</h2>
        <iframe 
            src="https://maps.google.com/maps?q=Faculty%20of%20Computing,%20UTM&t=&z=15&ie=UTF8&iwloc=&output=embed" 
            class="w-full h-48 border-none rounded-lg"></iframe>
        <div class="mt-4">
            <input 
                type="text" 
                id="search-location" 
                placeholder="Search location..." 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2">
            <button 
                onclick="searchLocation()" 
                class="w-full px-4 py-2 bg-purple-500 text-white rounded-lg font-semibold hover:bg-purple-600">
                Search Location
            </button>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="text-center text-gray-500 text-sm mt-16">
        <p>&copy; {{ date('Y') }} Timetable Management System. All rights reserved.</p>
    </div>
</div>

<script>
    function searchLocation() {
        let location = document.getElementById('search-location').value;
        if (location) {
            let googleMapsUrl = https://www.google.com/maps?q=${encodeURIComponent(location)};
            window.open(googleMapsUrl, '_blank');
        } else {
            alert('Please enter a location to search.');
        }
    }
</script>
@endsection