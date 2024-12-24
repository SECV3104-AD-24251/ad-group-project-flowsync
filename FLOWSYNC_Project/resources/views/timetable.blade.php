<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Schedule Management</title>
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

        .table {
            background-color: white;
            border: 1px solid #800000;
            border-radius: 10px;
            overflow: hidden;
        }

        .table th {
            background-color: #800000;
            color: white;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .form-select {
            border: 1px solid #800000;
        }

        .btn-primary {
            background-color: #800000;
            border-color: #800000;
        }

        .btn-primary:hover {
            background-color: #990000;
            border-color: #990000;
        }

        .ai-button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .ai-button {
            width: 70px;
            height: 70px;
            background-color: #ffffff;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .ai-button img {
            width: 50px;
            height: 50px;
        }

        .ai-button:hover {
            transform: scale(1.1);
            background-color: #990000;
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

        .table tbody tr[data-clash="true"] {
            background-color: #ffcccc;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25%, 75% { transform: translateX(-10px); }
            50% { transform: translateX(10px); }
        }
    </style>
</head>
<body>

    <!-- Back Button -->
    <a href="/dashboard" class="back-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        <span>Back</span>
    </a>

    <div class="container mt-5">
        <h1>Schedule Management</h1>

        <!-- Form for adding timetable entries -->
        <div class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <select id="courseCode" class="form-select">
                        <option value="">Select Course Code</option>
                        <option value="SECV3113">SECV3113</option>
                        <option value="SECV3104">SECV3104</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="courseName" class="form-select">
                        <option value="">Select Course Name</option>
                        <option value="Geometry Modelling">Geometry Modelling</option>
                        <option value="Application Development">Application Development</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="section" class="form-select">
                        <option value="">Select Section</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="timeSlot" class="form-select">
                        <option value="">Select Time Slot</option>
                        <option value="WED 10:00-13:00">WED 10:00-13:00</option>
                        <option value="THU 8:00-11:00">THU 8:00-11:00</option>
                    </select>
                </div>
            </div>

            <!-- Add button -->
            <div class="d-flex justify-content-end mt-3">
                <button id="addEntryBtn" class="btn btn-primary" aria-label="Add timetable entry">Add</button>
            </div>
        </div>

        <h3>Timetable Semester 1 Session 2024/2025 - 3 SECVH</h3>

        <!-- Display Timetable -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Section</th>
                        <th>Time Slot</th>
                    </tr>
                </thead>
                <tbody id="timetableBody">
                    <tr id="emptyRow">
                        <td colspan="4" class="text-center">No timetable entries yet.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Floating AI Button -->
    <div class="ai-button-container">
        <button id="aiAssistantBtn" class="ai-button" aria-label="Detect schedule clashes" onclick="detectClashes()">
            <img src="{{ asset('images/AI.png') }}" alt="AI Assistant">
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('/timetable/dropdown-data')
                .then(response => response.json())
                .then(data => {
                    populateDropdown('courseCode', data.courses, 'code');
                    populateDropdown('courseName', data.courses, 'name');
                    populateDropdown('section', data.sections, 'name');
                    populateDropdown('timeSlot', data.time_slots, 'slot');
                });

            function populateDropdown(elementId, items, key) {
                const dropdown = document.getElementById(elementId);
                items.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item[key];
                    option.textContent = item[key];
                    dropdown.appendChild(option);
                });
            }

            document.getElementById('addEntryBtn').addEventListener('click', () => {
                const courseCode = document.getElementById('courseCode').value;
                const courseName = document.getElementById('courseName').value;
                const section = document.getElementById('section').value;
                const timeSlot = document.getElementById('timeSlot').value;

                if (!courseCode || !courseName || !section || !timeSlot) {
                    Swal.fire('Please fill in all fields before adding!');
                    return;
                }

                const entry = { course_code: courseCode, course_name: courseName, section, time_slot: timeSlot };

                fetch('/timetable/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(entry),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        const tbody = document.getElementById('timetableBody');
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${courseCode}</td>
                            <td>${courseName}</td>
                            <td>${section}</td>
                            <td>${timeSlot}</td>
                        `;
                        if (document.getElementById('emptyRow')) {
                            document.getElementById('emptyRow').remove();
                        }
                        tbody.appendChild(row);
                    } else {
                        Swal.fire('Failed to add entry.');
                    }
                })
                .catch(error => Swal.fire(`Failed to add entry: ${error.message}`));
            });
        });

        function detectClashes() {
            fetch('/detect-clashes')
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        Swal.fire(data.message);
                    } else {
                        let clashes = '';
                        data.forEach(clash => {
                            clashes += `Clash detected:\n- ${clash.course1.course_name} (${clash.course1.section}) with ${clash.course2.course_name} (${clash.course2.section}) at ${clash.time_slot}\n\n`;
                        });
                        Swal.fire('Clashes Found', clashes, 'error');
                    }
                })
                .catch(error => Swal.fire('An error occurred while detecting clashes.'));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
