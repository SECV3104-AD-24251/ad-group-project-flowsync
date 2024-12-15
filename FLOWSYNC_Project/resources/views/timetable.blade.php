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

        <!-- Solution Button -->
<div class="solution-button-container">
    <button type="button" class="solution-button" data-bs-toggle="modal" data-bs-target="#solutionModal">
        📖 Recommendation
    </button>
</div>

<!-- Solution Modal -->
<div class="modal fade" id="solutionModal" tabindex="-1" aria-labelledby="solutionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="solutionModalLabel">Conflict Solutions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Loading solutions...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to handle clash detection and display solutions in the modal
    document.querySelector('.solution-button').addEventListener('click', function () {
        const modalBody = document.querySelector('#solutionModal .modal-body');
        modalBody.innerHTML = '<p>Loading solutions...</p>';

        fetch('{{ route('detect.clashes') }}')
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    let solutionHTML = '<ul>';
                    data.forEach(clash => {
                        solutionHTML += `<li><strong>Courses:</strong> ${clash.course1} and ${clash.course2}<br>`;
                        solutionHTML += `<strong>Sections:</strong> ${clash.section1} and ${clash.section2}<br>`;
                        solutionHTML += `<strong>Suggested Action:</strong> Move one class to another day (e.g., Thursday).</li><br>`;
                    });
                    solutionHTML += '</ul>';
                    modalBody.innerHTML = solutionHTML;
                } else {
                    modalBody.innerHTML = '<p>No clashes detected!</p>';
                }
            })
            .catch(error => {
                console.error('Error detecting clashes:', error);
                modalBody.innerHTML = '<p>An error occurred while detecting clashes.</p>';
            });
    });
</script>


    <!-- Floating AI Button -->
    <div class="ai-button-container">
        <button id="aiAssistantBtn" onclick="detectClashes()" class="ai-button">
            <img src="{{ asset('images/AI.png') }}" alt="AI Assistant Logo">
        </button>
    </div>

    <!-- Clash Detection Modal -->
    <div class="modal fade" id="clashModal" tabindex="-1" aria-labelledby="clashModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clashModalLabel">Clash Detection Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="clashResults">
                        <!-- Clash results will be dynamically populated here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // CONFLICT DETECTION FUNCTION
        function detectClashes() {
            // Show loading indicator in the modal
            const clashResults = document.getElementById('clashResults');
            clashResults.innerHTML = '<p>Detecting clashes... Please wait.</p>';

            // Show the modal
            const clashModal = new bootstrap.Modal(document.getElementById('clashModal'));
            clashModal.show();

            // Fetch clash detection results
            fetch('{{ route('detect.clashes') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        let clashMessage = '<ul>';
                        data.forEach(clash => {
                            clashMessage += `<li>
                                <strong>Courses:</strong> ${clash.course1} and ${clash.course2}<br>
                                <strong>Sections:</strong> ${clash.section1} and ${clash.section2}<br>
                                <strong>Time Slot:</strong> ${clash.time_slot}<br>
                            </li><hr>`;
                        });
                        clashMessage += '</ul>';
                        clashResults.innerHTML = clashMessage;
                    } else {
                        clashResults.innerHTML = '<p>No clashes detected!</p>';
                    }
                })
                .catch(error => {
                    console.error('Error detecting clashes:', error);
                    clashResults.innerHTML = '<p>An error occurred while detecting clashes. Please try again later.</p>';
                });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
