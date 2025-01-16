<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Timetable Management</title>
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
        /* Main container */
        .main-container {
            width: 80%;
            margin: 30px auto;
        }


        /* Student Info Section */
        .student-info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            font-size: 16px;
        }


        .student-info .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }


        .student-info .details div {
            width: 48%; /* For two columns */
        }


        .student-info .details span {
            font-weight: bold;
        }


        .student-info .btn-edit {
            background-color: #C8102E; /* UTM red */
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            width: 100px; /* Shorter width */
            margin-top: 10px;
        }


        .student-info .btn-edit:hover {
            background-color: #9e0000; /* Darker UTM red */
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


.footer {
            text-align: center;
            padding: 5px;
            background-color: #333;
            color: white;
            margin-top: 20px;
        }


        .footer a {
            color: #ffffff;
            text-decoration: none;
        }


        .footer a:hover {
            text-decoration: underline;
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
    <a href="/student-dashboard" class="back-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        <span>Back</span>
    </a>


    <header>
        <h1>Student Timetable Management</h1>
    </header>


    <div class="main-container">
        <!-- Student Info Section -->
        <div class="student-info">
            <div class="details">
                <div>
                    <p><span>Name:</span> John Doe</p>
                    <p><span>Email:</span> johndoe@utm.edu.my</p>
                </div>
                <div>
                    <p><span>Matric No:</span> A21CS1234</p>
                    <p><span>Phone:</span> +60 12 3456789</p>
                </div>
            </div>
            <div class="details">
                <div>
                    <p><span>Status:</span> Active</p>
                </div>
                <div>
                    <button class="btn-edit">Edit</button>
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
            <div class="card">
                <div>
                    <h3>Math Class</h3>
                    <p><strong>Day:</strong> Monday</p>
                    <p><strong>Time:</strong> 9:00 AM - 10:00 AM</p>
                    <p><strong>Location:</strong> Room 101</p>
                </div>
                <button>Edit</button>
            </div>
            <div class="card">
                <div>
                    <h3>Science Class</h3>
                    <p><strong>Day:</strong> Tuesday</p>
                    <p><strong>Time:</strong> 10:00 AM - 11:00 AM</p>
                    <p><strong>Location:</strong> Room 202</p>
                </div>
                <button>Edit</button>
            </div>
        </div>


        <!-- Timetable Table Section -->
        <div class="timetable-table">
            <h2>Your Weekly Timetable (Table View)</h2>
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>9:00 - 10:00 AM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>10:00 - 11:00 AM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>11:00 - 12:00 AM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>12:00 - 1:00 PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1:00 - 2:00 PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2:00 - 3:00 PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3:00 - 4:00 PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4:00 - 5:00 PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5:00 - 6:00 PM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>


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



