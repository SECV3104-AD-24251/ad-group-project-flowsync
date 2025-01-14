@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Page title -->
        <title>Timetable Management</title>

        <!-- Google Fonts for Nunito Font -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS for styling -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

        <!-- Font Awesome for moon and sun icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <style>
            /* Light mode styles */
            body {
                background-color: #f9fafb; /* Light background */
                color: #4b5563; /* Light text */
                transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition */
            }
            header {
                background: linear-gradient(to right, #ef4444, #dc2626); /* Light mode header */
            }
            footer {
                background-color: #f3f4f6; /* Light mode footer */
                color: #4b5563; /* Light footer text */
            }
            .dark-mode-toggle i {
                color: #1f2937; /* Dark icon color for light mode */
            }

            /* Dark mode styles */
            body.dark {
                background-color: #000000; /* Really black background */
                color: #ffffff; /* White text */
            }
            header.dark {
                background: linear-gradient(to right, #000000, #000000); /* Black header */
            }
            footer.dark {
                background-color: #000000; /* Black footer */
                color: #ffffff; /* White footer text */
            }

            body.dark h3 {
                color: #4b5563; /* Ensure headers are visible in dark mode */
            }

            .dark-mode-toggle i {
                color: #ffffff; /* White icon for dark mode */
            }

            /* Remove background and style the button */
            .dark-mode-toggle {
                background: none;         /* Remove background */
                border: none;             /* Remove border */
                padding: 0;               /* Remove padding */
                cursor: pointer;         /* Pointer cursor on hover */
            }

            /* Add some space around the button icon */
            .dark-mode-toggle i {
                font-size: 1.5rem;        /* Icon size */
                transition: color 0.3s;   /* Smooth color transition */
            }

            /* Hover effect on the button */
            .dark-mode-toggle:hover i {
                color: #ef4444;           /* Red color on hover */
            }

            /* Input fields and links */
            input, a {
                transition: color 0.3s ease, background-color 0.3s ease;
            }

            input {
                background-color: #fff;
                color: #333;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
            }

            .dark input {
                background-color: #333;
                color: #fff;
                border: 1px solid #555;
            }

            a {
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .dark a {
                color: #ffffff; /* Links in dark mode should be white */
            }

            body.dark-mode {
                background-color: #121212;
                color: #ffffff;
            }

            body.dark-mode .calendar-container h3,
            body.dark-mode .map-container h3,
            body.dark-mode .links-container h3 {
                color: #ffffff; /* Ensure headers are visible */
            }

            body.dark-mode a {
                color: #4cc9f0; /* Adjust link color for better visibility */
            }

            body.dark-mode input {
                background-color: #333333;
                color: #ffffff;
            }
        </style>
    </head>
    <body class="antialiased">
        <!-- HEADER -->
        <header class="text-white shadow-lg">
            <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">

                <!-- Logo Section -->
                <a href="/" class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-white rounded-full" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    <span class="ml-3 text-xl font-bold">TIMETABLE MANAGEMENT</span>
                </a>

                <!-- Navigation Menu -->
                <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                    <a class="mr-5 hover:text-gray-200 transition duration-200" href="/student-timetable">Timetable</a>
                    <a class="mr-5 hover:text-gray-200 transition duration-200" href="/student-calendar">Calendar</a>
                    <a class="mr-5 hover:text-gray-200 transition duration-200" href="/helpCenter">Help</a>
                    <a class="mr-5 hover:text-gray-200 transition duration-200" href="/solution">Solution</a>

                    <!-- Conditional Rendering for Login/Logout -->
                    @if(session('user'))
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button class="mr-5 bg-white text-red-500 hover:bg-gray-200 rounded px-3 py-1 transition duration-200">Logout</button>
                        </form>
                    @else
                        <a class="mr-5 bg-white text-red-500 hover:bg-gray-200 rounded px-3 py-1 transition duration-200" href="/login">Login</a>
                    @endif

                    <!-- Dark Mode Toggle Button -->
                    <button class="dark-mode-toggle" onclick="toggleDarkMode()">
                        <i class="fas fa-moon"></i>
                    </button>
                </nav>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main>
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer class="text-gray-600">
            <div class="container mx-auto px-5 py-8 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-sm text-gray-500 sm:mb-0">© 2024 FlowSync. All rights reserved.</p>
                <div class="flex mt-4 sm:mt-0">
                    <a href="#" class="text-gray-400 hover:text-gray-700 mx-2">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-gray-700 mx-2">Terms</a>
                </div>
            </div>
        </footer>

        <script>
            // Toggle dark mode
            function toggleDarkMode() {
                // Toggle the dark class on body
                document.body.classList.toggle('dark');

                // Change the icon based on the current mode
                const icon = document.querySelector('.dark-mode-toggle i');
                if (document.body.classList.contains('dark')) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            }
        </script>
    </body>
</html>

@endsection