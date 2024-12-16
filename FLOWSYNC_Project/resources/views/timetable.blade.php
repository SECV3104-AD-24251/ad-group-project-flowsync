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
            background: linear-gradient(to bottom, #F2E5E5, #bf7f7f);
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
                    @foreach($timetable as $row)
                        <tr>
                            <td>{{ $row->course_code }}</td>
                            <td>{{ $row->course_name }}</td>
                            <td>{{ $row->section }}</td>
                            <td>{{ $row->time_slot }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Floating AI Button -->
    <div class="ai-button-container">
        <button id="aiAssistantBtn" onclick="detectClashesAndSolutions()" class="ai-button">
            <img src="{{ asset('images/AI.png') }}" alt="AI Assistant Logo">
        </button>
    </div>

<!-- Clash Detection Modal -->
<div class="modal fade" id="clashModal" tabindex="-1" aria-labelledby="clashModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clashModalLabel">Clash Detection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="clashResults">
                    <!-- Clash results will be dynamically populated here -->
                </div>
                <div id="solutionResults" style="display:none;">
                    <!-- Solution results will be dynamically populated here -->
                </div>
            </div>
            <div class="modal-footer">
                <!-- Back button to return to clash detection -->
                <button type="button" class="btn btn-secondary" id="backToClashesBtn" onclick="showClashes()" style="display: none;">Back</button>
                <button type="button" class="btn btn-primary" id="showSolutionsBtn" onclick="showSolutions()">Show Solutions</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
let clashData = []; // Store the clash data globally

function detectClashesAndSolutions() {
    const clashResults = document.getElementById('clashResults');
    const solutionResults = document.getElementById('solutionResults');
    const clashModalLabel = document.getElementById('clashModalLabel'); // Access the modal title
    const backToClashesBtn = document.getElementById('backToClashesBtn');
    const showSolutionsBtn = document.getElementById('showSolutionsBtn');

    clashResults.innerHTML = '<p>Detecting clashes... Please wait.</p>';
    solutionResults.style.display = 'none'; // Hide solutions initially
    backToClashesBtn.style.display = 'none'; // Hide back button initially
    showSolutionsBtn.style.display = 'inline-block'; // Show solutions button

    const clashModal = new bootstrap.Modal(document.getElementById('clashModal'));
    clashModal.show();

    // Fetch clash data and update the modal dynamically
    fetch('{{ route('detect.clashes') }}')
        .then(response => response.json())
        .then(data => {     // Handle responses
            setTimeout(() => {
                if (data.message === 'No timetable data available.') {
                    clashResults.innerHTML = '<p>No timetable data available!</p>';
                } else if (data.message === 'No clashes detected.') {
                    clashResults.innerHTML = '<p>No conflicts detected!</p>';
                } else {
                    clashData = data; // Store clash data for later use
                    let clashMessage = '<h5>Clash Details:</h5><ul>';
                    data.forEach(clash => {
                        clashMessage += `
                            <li>
                                <strong>Conflict between:</strong><br>
                                Course 1: ${clash.course1.course_code} - ${clash.course1.course_name}, Section: ${clash.course1.section} <br>
                                Course 2: ${clash.course2.course_code} - ${clash.course2.course_name}, Section: ${clash.course2.section} <br>
                                <strong>Time Slot:</strong> ${clash.time_slot}
                            </li><hr>`;
                    });
                    clashMessage += '</ul>';
                    clashResults.innerHTML = clashMessage;
                }
            }, 1000); // 1-second delay
        })
        .catch(error => {       // Handle errors during fetch
            setTimeout(() => {
                clashResults.innerHTML = '<p>An error occurred while detecting clashes.</p>';
            }, 1000); // 1-second delay
        });
}

// Display suggested solutions and update modal view
function showSolutions() {
    const solutionResults = document.getElementById('solutionResults');
    const clashResults = document.getElementById('clashResults');
    const backToClashesBtn = document.getElementById('backToClashesBtn');
    const showSolutionsBtn = document.getElementById('showSolutionsBtn');
    const modalTitle = document.getElementById('clashModalLabel'); 

    let solutionMessage = '<h5>Suggested Solutions:</h5><ul>';
    clashData.forEach(clash => {
        solutionMessage += `
            <li>
                To resolve the clash between ${clash.course1.course_code} and ${clash.course2.course_code}, consider moving one class to another day (e.g., Thursday).
            </li>`;
    });
    solutionMessage += '</ul>';

    solutionResults.innerHTML = solutionMessage;
    solutionResults.style.display = 'block'; // Show solutions
    clashResults.style.display = 'none'; // Hide clash details
    backToClashesBtn.style.display = 'inline-block'; // Show back button
    showSolutionsBtn.style.display = 'none'; // Hide solutions button

    modalTitle.textContent = 'Clash Solution'; // Change title to "Clash Solution"
}

// Revert back to clash details view
function showClashes() {
    const solutionResults = document.getElementById('solutionResults');
    const clashResults = document.getElementById('clashResults');
    const backToClashesBtn = document.getElementById('backToClashesBtn');
    const showSolutionsBtn = document.getElementById('showSolutionsBtn');
    const modalTitle = document.getElementById('clashModalLabel');

    solutionResults.style.display = 'none'; // Hide solutions
    clashResults.style.display = 'block'; // Show clash details
    backToClashesBtn.style.display = 'none'; // Hide back button
    showSolutionsBtn.style.display = 'inline-block'; // Show solutions button

    modalTitle.textContent = 'Clash Detection';
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
