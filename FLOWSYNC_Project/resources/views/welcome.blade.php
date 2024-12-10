@extends('layouts.app')

@section('content')
<div class="dashboard-container text-center text-black py-10">
    <h1 class="text-4xl font-bold mb-4">Welcome to Timetable Management System</h1>
    <p class="text-lg">Hello, {{ session('user') }}! Stay organized and achieve your goals.</p>
</div>

<!-- MAIN PAGE -->
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap -m-4 justify-center">
        <!-- FIRST BOX (TIMETABLE) -->
        <div class="p-4 lg:w-1/3">
            <a href="{{ route('login') }}" class="block h-full bg-gradient-to-r from-red-100 to-red-300 hover:from-red-200 hover:to-red-400 transition-all duration-300 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative shadow-lg hover:shadow-2xl">
                <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">TIMETABLE</h1>
                <p class="leading-relaxed mb-3">Semester 1 Session 2024/2025</p>
                <span class="text-black-700 inline-flex items-center font-bold hover:underline">Learn More
                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="M12 5l7 7-7 7"></path>
                    </svg>
                </span>
            </a>
        </div>

        <!-- SECOND BOX (CALENDAR) -->
        <div class="p-4 lg:w-1/3">
            <a href="{{ route('login') }}" class="block h-full bg-gradient-to-r from-red-100 to-red-300 hover:from-red-200 hover:to-red-400 transition-all duration-300 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative shadow-lg hover:shadow-2xl">
                <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">CALENDAR</h1>
                <p class="leading-relaxed mb-3">Google Calendar Integration</p>
                <span class="text-black-700 inline-flex items-center font-bold hover:underline">Learn More
                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="M12 5l7 7-7 7"></path>
                    </svg>
                </span>
            </a>
        </div>
        
    </div>
  </div>
</section>
@endsection
