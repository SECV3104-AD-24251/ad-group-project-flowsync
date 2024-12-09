<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/timetable.css') }}">
    <style>
        body {
            background: linear-gradient(to bottom, #F2E5E5, #bf7f7f); /* Gradient background */
            font-family: 'Arial', sans-serif;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333333;
            text-align: center;
            margin-bottom: 30px;
        }

        .table {
            background-color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        /* Back Button */
        .back-button-container {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .back-button {
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: #333333;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .back-button:hover {
            color: #555555;
            transform: scale(1.1);
        }

        /* AI Button (Floating) */
        .ai-button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .ai-button {
            width: 60px;
            height: 60px;
            background-color: #FF8D33;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .ai-button img {
            width: 30px;
            height: 30px;
        }

        .ai-button:hover {
            transform: scale(1.1);
            background-color: #FF5733;
        }

        .solution-button-container {
            margin-top: 30px;
            text-align: center;
        }

        .solution-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #8B0000;
            color: #FFFFFF;
            font-weight: bold;
            text-decoration: none;
            border-radius: 30px;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .solution-button:hover {
            background-color: #B22222;
            transform: scale(1.1);
        }

        .table-hover tbody tr:hover {
            background-color: #FFFAE5;
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5 fade-in">
        <!-- Back Button -->
        <div class="back-button-container">
            <a href="{{ route('dashboard') }}" class="back-button">⬅ Back</a>
        </div>

        <h1>Timetable Semester 1 Session 2024/2025</h1>

        <!-- Display Timetable -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Section</th>
                        <th>Time Slot</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Rows -->
                    <tr>
                        <td>CMP101</td>
                        <td>Introduction to Computing</td>
                        <td>A</td>
                        <td>Monday, 9:00 AM - 10:30 AM</td>
                    </tr>
                    <tr>
                        <td>CMP202</td>
                        <td>Data Structures</td>
                        <td>B</td>
                        <td>Tuesday, 11:00 AM - 12:30 PM</td>
                    </tr>
                    <!-- Dynamic rows will be rendered here -->
                </tbody>
            </table>
        </div>

        <!-- Solution Button -->
        <div class="solution-button-container">
            <a href="{{ route('solution') }}" class="solution-button">📖 View Conflict Solution</a>
        </div>
    </div>

    <!-- Floating AI Button -->
    <div class="ai-button-container">
        <button id="aiAssistantBtn" onclick="detectClashes()" class="ai-button">
            <img src="{{ asset('images/AI.png') }}" alt="AI Assistant Logo">
        </button>
    </div>

    <script>
        // Function to handle clash detection when AI button is clicked
        function detectClashes() {
            alert('AI Assistant is analyzing your schedule for clashes!');
        }
    </script>
</body>
</html>
