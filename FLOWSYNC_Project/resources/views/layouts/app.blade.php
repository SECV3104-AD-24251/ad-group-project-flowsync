<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- STYLES -->
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    </head>

<!-- EDIT HERE --> 
    <body class="antialiased">
        <!-- HEADER WEBSITE -->
        <header class="text-gray-600 body-font">
            <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
                <a href="/" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-red-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>
                <span class="ml-3 text-xl">FLOWSYNC</span>
                </a>
                <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900" href="/CLIENTS">Clients</a>
                <a class="mr-5 hover:text-gray-900" href="/ABOUT">About</a>
                <a class="mr-5 hover:text-gray-900" href="/CONTACT">Contact</a>
                <a class="mr-5 hover:text-gray-900" href="/login">Login</a>
                </nav>               
            </div>
        </header>

        <main class="max-w-4xl mx-auto">    <!-- KEDUDUKAN AYAT -->
            {{ $slot }}  <!-- CALL AYAT -->
        </main>

    </body>
</html>
