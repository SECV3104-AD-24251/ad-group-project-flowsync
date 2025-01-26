<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Lecturer Schedule Management</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Arial', sans-serif;
            color: #333333;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #800000;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            align-items: center;
            text-decoration: none;
            background-color: #800000;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .back-button:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.3);
        }

        .back-button svg {
            margin-right: 8px;
            fill: white;
        }

        .back-button span {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Main container */
        .main-container {
            width: 80%;
            margin: 30px auto;
        }

        /* lecturer Info Section */
        .lecturer-info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            font-size: 16px;
        }

        .lecturer-info .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .lecturer-info .details div {
            width: 48%; /* For two columns */
        }

        .lecturer-info .details span {
            font-weight: bold;
        }

        /* Timetable toggle button */
        .toggle-button {
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }

        .toggle-button button {
            background-color: #C8102E; /* UTM red */
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .toggle-button button:hover {
            background-color: #9e0000;
        }

        /* Timetable Cards and Table Styles */
        .timetable-cards, .timetable-table {
            display: none;
        }

        .timetable-cards.active, .timetable-table.active {
            display: block;
        }

        /* Cards layout */
        .timetable-cards .card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border:rgb(153, 0, 0);
            border-radius: 6px;
        }    

        .card h3 {
            font-size: 18px;
            color: #333;
        }

        .card p {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .card button {
            background-color: #C8102E; /* UTM red */
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }

        .card button:hover {
            background-color: #9e0000;
        }

        /* Table layout */
        .timetable-table table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(200, 16, 46, 0.75); /* Strong red UTM shadow */
            border-radius: 10px;
            margin: 20px 0; /* Adds spacing around the table */
            overflow: hidden; /* Ensures rounded corners are visible */
        }

        .timetable-table th, .timetable-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .timetable-table th {
            background-color: #C8102E; /* UTM red */
            color: white;
            font-weight: bold;
        }

        /* Add shadow when the cursor is hovering over the elements */
        .timetable-cards:hover, .timetable-details:hover, .timetable-table:hover {
            box-shadow: 0 0 20px rgba(200, 16, 46, 0.75); /* UTM red shadow */
            transition: box-shadow 0.3s ease-in-out; /* Smooth effect */
        }

        /* Default shadow when not hovered */
        .timetable-cards, .timetable-details, .timetable-table {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Light shadow by default */
            transition: box-shadow 0.3s ease-in-out;
        }

        /* Table layout */
        .timetable-table table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Updated shadow */
            border-radius: 8px;
            overflow: hidden; /* Ensures rounded corners are visible */
            margin: 20px 0; /* Adds some spacing around the table */
        }
    </style>
</head>

<body>
    <!-- Back Button -->
    <a href="/lecturer-dashboard" class="back-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        <span>Back</span>
    </a>

    <div class="container mt-5">
        <h1>Lecturer Schedule Management</h1>

        <div class="main-container">
            <!-- Lecturer Info Section -->
            <div class="lecturer-info">
                <div class="details">
                    <div>
                        <p><span>Lecturer Name:</span> Dr. Zulaikha</p>
                        <p><span>Email:</span> zulaikha@utm.edu.my</p>
                    </div>
                    <div>
                        <p><span>Staff ID:</span> S24FC0001</p>
                        <p><span>Phone Number:</span> +6019 7645634</p>
                    </div>
                </div>
                <div class="details">
                    <div>
                        <p><span>Status:</span> Active</p>
                    </div>
                </div>
            </div>

            <!-- Toggle Button -->
            <div class="toggle-button">
                <button id="toggleView">Switch to Table View</button>
            </div>

            <!-- Timetable Cards Section -->
            <div class="timetable-cards active">
                <h2>Your Weekly Timetable (Card View)</h2>

                @forelse ($timetable as $day => $classes)
                    <h3>{{ ucfirst($day) }}</h3>
                    @foreach ($classes as $class)
                        <div class="card">
                            <div>
                                <h3>{{ $class->subject }}</h3>
                                <p><strong>Time:</strong> {{ $class->time }}</p>
                                <p><strong>Time Slot:</strong> {{ $class->slot }}</p>
                            </div>
                            <button>Edit</button>
                        </div>
                    @endforeach
                @empty
                    <p>No timetable data available.</p>
                @endforelse

            </div>

            <!-- Timetable Table Section -->
            <div class="timetable-table">
                <h2>Your Weekly Timetable (Table View)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Time</th>
                            @foreach ($days as $day)
                                <th>{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timeSlots as $time)
                            <tr>
                                <td>{{ $time }}</td>
                                @foreach ($days as $day)
                                    <td>
                                        @if (isset($timetable[$day]))
                                            @php
                                                $class = $timetable[$day]->firstWhere('time', $time);
                                            @endphp
                                            @if ($class)
                                                <strong>{{ $class->subject }}</strong><br>
                                                Slot: {{ $class->slot }}
                                            @else
                                                -
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="main-container">
            <!-- Insert Button -->
            <div class="insert-button" style="text-align: center; margin: 20px 0;">
                <button id="openInsertModal" style="background-color: #C8102E; color: white; padding: 12px 24px; font-size: 16px; border: none; border-radius: 4px; cursor: pointer;">
                    Insert into Timetable
                </button>
            </div>

            <!-- Insert Modal -->
            <div id="insertModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); padding: 20px; width: 50%; z-index: 1000;">
                <h2 style="text-align: center; color: #C8102E;">Insert Timetable Entry</h2>
                <form id="insertForm" action="{{ route('lecturer.timetable.store') }}" method="POST">
                    @csrf <!-- Laravel CSRF Token -->
                    <div style="margin-bottom: 10px;">
                        <label for="day" style="font-weight: bold;">Day:</label>
                        <select id="day" name="day" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label for="time" style="font-weight: bold;">Time:</label>
                        <input type="time" id="time" name="time" required style="width: 96%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label for="subject" style="font-weight: bold;">Subject:</label>
                        <input type="text" id="subject" name="subject" required placeholder="Enter subject" style="width: 96%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label for="slot" style="font-weight: bold;">Slot:</label>
                        <select id="slot" name="slot" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                            <option value="" disabled selected>Choose a slot</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>

                    <div style="text-align: center;">
                        <button type="submit" style="background-color: #C8102E; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Save</button>
                        <button type="button" id="closeInsertModal" style="background-color: #ddd; color: black; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Background overlay for modal -->
            <div id="modalOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;"></div>
        </div>

        <script>
            const openInsertModal = document.getElementById('openInsertModal');
                const closeInsertModal = document.getElementById('closeInsertModal');
                const insertModal = document.getElementById('insertModal');
                const modalOverlay = document.getElementById('modalOverlay');

                openInsertModal.addEventListener('click', () => {
                    insertModal.style.display = 'block';
                    modalOverlay.style.display = 'block';
                });

                closeInsertModal.addEventListener('click', () => {
                    insertModal.style.display = 'none';
                    modalOverlay.style.display = 'none';
                });

                modalOverlay.addEventListener('click', () => {
                    insertModal.style.display = 'none';
                    modalOverlay.style.display = 'none';
                });
        </script>

        <footer class="footer">
            <p>&copy; 2025 Student Timetable Management System. All Rights Reserved. | <a href="#">Privacy Policy</a></p>
        </footer>

    </div>

    <!-- FontAwesome Icons (For the details section) -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
        const toggleButton = document.getElementById('toggleView');
        const cardView = document.querySelector('.timetable-cards');
        const tableView = document.querySelector('.timetable-table');

        toggleButton.addEventListener('click', () => {
            cardView.classList.toggle('active');
            tableView.classList.toggle('active');
            toggleButton.textContent = cardView.classList.contains('active') ? 'Switch to Table View' : 'Switch to Card View';
        });
    </script>
    
</body>
</html>