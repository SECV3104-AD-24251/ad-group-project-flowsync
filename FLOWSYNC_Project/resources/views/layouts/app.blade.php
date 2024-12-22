<!DOCTYPE html>
<!-- Dynamically sets the language attribute -->
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
    </head>
    <body class="antialiased bg-gray-50 text-gray-700">
        <!-- HEADER -->
        <header class="bg-gradient-to-r from-red-500 to-red-700 text-white shadow-lg">
            <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">

                <!-- Logo Section -->
                <a href="/" class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                    <!-- Logo Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-white rounded-full" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    <!-- Title -->
                    <span class="ml-3 text-xl font-bold">TIMETABLE MANAGEMENT</span>
                </a>

                <!-- Navigation Menu -->
                <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                    <!-- Navigation Links -->
                    <a class="mr-5 hover:text-gray-200 transition duration-200" href="/timetable">Timetable</a>
                    <a class="mr-5 hover:text-gray-200 transition duration-200" href="/calendar">Calendar</a>
                    <a class="mr-5 hover:text-gray-200 transition duration-200" href="/helpCenter">Help</a>
                    <a class="mr-5 hover:text-gray-200 transition duration-200" href="/solution">Solution</a>


                    <!-- Conditional Rendering for Login/Logout -->
                    @if(session('user'))
                        <!-- Logout Form -->
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf       <!-- CSRF token for form security -->
                            <button class="mr-5 bg-white text-red-500 hover:bg-gray-200 rounded px-3 py-1 transition duration-200">Logout</button>
                        </form>
                    @else       <!-- If no user is logged in -->
                        <!-- Login Button -->
                        <a class="mr-5 bg-white text-red-500 hover:bg-gray-200 rounded px-3 py-1 transition duration-200" href="/login">Login</a>
                    @endif
                </nav>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main>      <!-- Main section where page-specific content will be injected -->
            @yield('content')       <!-- Yields content defined in other blade files -->
        </main>

        <!-- FOOTER -->
        <footer class="bg-gray-100 text-gray-600">
            <div class="container mx-auto px-5 py-8 flex flex-col sm:flex-row justify-between items-center">
                <!-- Footer Copyright -->
                <p class="text-sm text-gray-500 sm:mb-0">© 2024 FlowSync. All rights reserved.</p>
                
                <!-- Footer Links -->
                <div class="flex mt-4 sm:mt-0">
                    <a href="#" class="text-gray-400 hover:text-gray-700 mx-2">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-gray-700 mx-2">Terms</a>
                </div>
            </div>
        </footer>
    </body>
</html>