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
            background-color: lightpink; /* Set the background to light pink */
        }

        .table-bordered {
            border: 2px solid black !important; /* Ensure the table has black borders */
        }

        /* AI Button Container (Align Left) */
        .ai-button.left {
            display: flex;
            justify-content: left; /* Align the button to the left */
            margin-top: -100px;
            margin-bottom: 10px; /* Adds space between the button and the table */
        }

        .ai-button {
            padding: 2px 5px; /* Increase the size of the button */
            font-size: 5px; /* Increase the font size */
            font-weight: bold;
            background-color: #ff8d33;
            color: lightorange;
            border: none;
            border-radius: 5px; /* Rounded corners */
            cursor: pointer;
            text-align: center;
            margin-right: 10px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .ai-button .ai-icon {
            width: 110px;  /* Resize the image */
            height: 110px; /* Resize the height to maintain aspect ratio */
        }

        .ai-button:hover {
            transform: scale(1.1); /* Slight zoom effect on hover */
            background-color: #ff5733; 
        }

        /* Solution Button Container */
        .solution-button-container {
            margin-top: 50px; /* Add more space above the button */
            text-align: center; /* Ensure the button is centered */
        }

        .solution-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #8B0000; /* Maroon color */
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .solution-button:hover {
            background-color: #B22222; /* Darker maroon on hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Schedule</h1>

        <!-- AI Button to detect clashes -->
        <div class="ai-button-container">
            <button id="aiAssistantBtn" onclick="detectClashes()" class="ai-button">
                <img src="{{ asset('images/AI.png') }}" alt="AI Assistant Logo" class="ai-icon">
            </button>
        </div>

        <!-- Display Timetable -->
        <div class="container mt-5 text-center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Section</th>
                        <th>Time Slot</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamically render timetable rows here (using Blade or JavaScript) -->
                </tbody>
            </table>
        </div>

        <!-- Solution Button Below the Table -->
        <div class="solution-button-container">
            <a href="{{ route('solution') }}" class="solution-button">Go to Solution</a>
        </div>
    </div>

    <script>
        // Function to handle clash detection when AI button is clicked
        function detectClashes() {
            // You can add logic here to send the form data or timetable details to the OpenAI API
            alert('Clash detection function triggered!');
        }
    </script>
</body>
</html>
