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
            background: linear-gradient(to right, #780b0b, #e88989); /* Light mode header */
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

/* Sidebar styles */
.sidebar {
    width: 250px;
    background: linear-gradient(to bottom, #810606, #eac6c6);
    color: #ffffff;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    padding: 20px;
    overflow-y: auto;
    transform: translateX(-100%);
    transition: transform 0.3s ease-in-out;
    z-index: 1000;

    /* Flexbox for vertical alignment */
    display: flex;
    flex-direction: column;
    align-items: center; /* Center items horizontally */
    text-align: center; /* Center all text */
}

.sidebar.open {
    transform: translateX(0);
}

.sidebar .logo {
    margin-bottom: 30px; /* Space below the logo */
}

.sidebar .logo img {
    width: 90px;
    height: 80px;
}

.sidebar .menu-heading {
    margin-bottom: 20px; /* Space below the "MENU" heading */
}

.sidebar .menu-heading h3 {
    font-size: 1.2rem;
    font-weight: bold;
    color: rgba(255, 255, 255, 0.8);
}

.sidebar .menu {
    display: flex;
    flex-direction: column; /* Stack menu items vertically */
    align-items: center; /* Center menu items horizontally */
    gap: 15px; /* Add spacing between menu items */
}

.sidebar a {
    display: flex;
    align-items: center;
    justify-content: center; /* Center text and icon horizontally */
    color: #ffffff;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    width: 100%; /* Ensure links take full width for better alignment */
    text-align: center; /* Center the text inside the link */
}

.sidebar a:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.sidebar a i {
    margin-right: 10px;
}        /* Toggle button in the header */
        .toggle-sidebar-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            margin-right: 10px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        #close-sidebar {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    color:rgb(0, 0, 0);
    font-size: 1.5rem;
    cursor: pointer;
    transition: color 0.3s ease;
}

#close-sidebar:hover {
    color: #f3f4f6; /* Light gray on hover */
}

        .toggle-sidebar-btn:hover {
            color: #f3f4f6;
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
    </style>
</head>
<body class="antialiased">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
    <button id="close-sidebar" class="text-white text-lg absolute top-4 right-4">✖</button>
    <!-- Logo Section -->
    <div class="logo">
        <img src="images/logo.png" alt="Timetable Management Logo">
    </div>

    <!-- Menu Heading -->
    <div class="menu-heading">
        <h3>MENU</h3>
    </div>

    <!-- Menu Section -->
    <div class="menu">
            <a href="/timetable">
                <i class="fas fa-calendar-alt"></i> Timetable
            </a>
            <a href="/calendar">
                <i class="fas fa-calendar"></i> Calendar
            </a>
            <a href="/campus-map">
                <i class="fas fa-map-marker-alt"></i> Interactive Map
            </a>
        </div>
    </div>
    <!-- HEADER -->
    <header class="text-white shadow-lg">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <!-- Sidebar Toggle Button -->
            <button id="toggle-sidebar" class="toggle-sidebar-btn">☰</button>

            <!-- Logo Section -->
                <img src="images/logo.png" style="height:50px"alt="Timetable Management Logo">
                <span class="ml-3 text-xl font-bold">TIMETABLE MANAGEMENT</span>
            </a>

            <!-- Navigation Menu -->
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-200 transition duration-200" href="/timetable">Timetable</a>
                <a class="mr-5 hover:text-gray-200 transition duration-200" href="/calendar">Calendar</a>

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
    <main class="container mx-auto mt-10">
        <!-- Dynamic Content -->
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
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const toggleSidebarBtn = document.getElementById('toggle-sidebar');
    const closeSidebarBtn = document.getElementById('close-sidebar'); // Close button

    // Toggle button functionality: Opens the sidebar
    toggleSidebarBtn.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevents the click from propagating to the document
        sidebar.classList.add('open');
    });

    // Close button functionality: Closes the sidebar
    closeSidebarBtn.addEventListener('click', () => {
        sidebar.classList.remove('open');
    });

    // Close the sidebar when clicking outside of it
    document.addEventListener('click', (event) => {
        if (!sidebar.contains(event.target) && !toggleSidebarBtn.contains(event.target)) {
            sidebar.classList.remove('open');
        }
    });
});
        // Toggle dark mode
        function toggleDarkMode() {
            document.body.classList.toggle('dark');
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

