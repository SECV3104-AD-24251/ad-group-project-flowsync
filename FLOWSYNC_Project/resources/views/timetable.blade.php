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
            color: light orange;
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
</style>
</head>
<body>
    <div class="container mt-5">
       <h1>Schedule</h1>
       <div class="ai-button-container">
       <button id="aiAssistantBtn" onclick="detectClashes()" class="ai-button">
                <img src="{{ asset('images/AI.png') }}" alt="AI Assistant Logo" class="ai-icon">
            </button>
    <div class="container mt-5 text-center">
        </style>
        <!-- Test with static data to see if rendering works -->
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
            <tr>
                <td>SECVH101</td>
                <td>Intro to Computer Science</td>
                <td>01</td>
                <td>Monday 10:00-12:00</td>
            </tr>
            <tr>
                <td>SECVH102</td>
                <td>Data Structures</td>
                <td>02</td>
                <td>Tuesday 14:00-16:00</td>
            </tr>
            <tr>
                <td>SECVH201</td>
                <td>Advanced Mathematics</td>
                <td>03</td>
                <td>Monday 11:00-13:00</td>
            </tr>
            <tr>
                <td>SECVH202</td>
                <td>Discrete Mathematics</td>
                <td>02</td>
                <td>Monday 10:00-12:00</td>
            </tr>
            <tr>
                <td>SECVH301</td>
                <td>Computer Networks</td>
                <td>01</td>
                <td>Wednesday 13:00-15:00</td>
            </tr>
            <tr>
                <td>SECVH302</td>
                <td>Operating Systems</td>
                <td>03</td>
                <td>Tuesday 15:00-17:00</td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>