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

    <!-- Font Awesome for icons -->
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

        /* Dark mode styles */
        body.dark {
            background-color: #000000; /* Dark background */
            color: #ffffff; /* Dark text */
        }
        header.dark {
            background: linear-gradient(to right, #000000, #000000); /* Dark mode header */
        }
        footer.dark {
            background-color: #000000; /* Dark mode footer */
            color: #ffffff; /* Dark footer text */
        }

        /* Dark mode toggle button */
        .dark-mode-toggle {
            background: none;
            border: none;
            cursor: pointer;
        }

        .dark-mode-toggle i {
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .dark-mode-toggle:hover i {
            color: #ef4444; /* Red color on hover */
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

        html {
            scroll-behavior: smooth; /* Enable smooth scrolling */
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
                <a class="mr-5 hover:text-gray-200 transition duration-200" href="/timetable">Timetable</a>
                <a class="mr-5 hover:text-gray-200 transition duration-200" href="https://calendar.google.com/calendar/u/0/r?pli=1">Calendar</a>

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
    <script>
document.addEventListener('DOMContentLoaded', () => {
    // Get all sidebar links
    const sidebarLinks = document.querySelectorAll('.menu a');

    sidebarLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default link behavior

            // Get the target section's id from the href attribute
            const targetId = link.getAttribute('href').slice(1); // Remove the '#' symbol
            const targetSection = document.getElementById(targetId);

            if (targetSection) {
                // Scroll to the section smoothly
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});
</script>

</body>
</html>
@endsection