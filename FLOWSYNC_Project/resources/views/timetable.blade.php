<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #F2E5E5, #bf7f7f);
            font-family: 'Arial', sans-serif;
        }

        h1 {
            font-size: 2rem;
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

        .ai-button-container {
            position: fixed;
            top: 20px;
            right: 20px;
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Schedule Management</h1>

        <!-- Form for adding timetable entries -->
        <div class="mb-4">
    <div class="row g-2">
        <div class="col-md-3">
            <select id="courseCode" class="form-select">
                <option value="">Select Course Code</option>
                <option value="CS101">CS101</option>
                <option value="CS102">CS102</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="courseName" class="form-select">
                <option value="">Select Course Name</option>
                <option value="Intro to Programming">Intro to Programming</option>
                <option value="Data Structures">Data Structures</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="section" class="form-select">
                <option value="">Select Section</option>
                <option value="A">A</option>
                <option value="B">B</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="timeSlot" class="form-select">
                <option value="">Select Time Slot</option>
                <option value="8:00 - 10:00">8:00 - 10:00</option>
                <option value="10:00 - 12:00">10:00 - 12:00</option>
            </select>
        </div>
    </div>

    <!-- Add button wrapped in a flexbox container -->
    <div class="d-flex justify-content-end mt-3">
        <button id="addEntryBtn" class="btn btn-primary">Add</button>
    </div>
</div>

        <!-- Display Timetable -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Section</th>
                        <th>Time Slot</th>
                    </tr>
                </thead>
                <tbody id="timetableBody">
                    <!-- Entries will be dynamically added here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Floating AI Button -->
    <div class="ai-button-container">
        <button id="aiAssistantBtn" class="ai-button" onclick="detectClashes()">
            <img src="{{ asset('images/AI.png') }}" alt="AI">
        </button>
    </div>

    <script>
// Add new entry to the table
document.getElementById('addEntryBtn').addEventListener('click', () => {
    const courseCode = document.getElementById('courseCode').value;
    const courseName = document.getElementById('courseName').value;
    const section = document.getElementById('section').value;
    const timeSlot = document.getElementById('timeSlot').value;

    if (courseCode && courseName && section && timeSlot) {
        const tbody = document.getElementById('timetableBody');
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${courseCode}</td>
            <td>${courseName}</td>
            <td>${section}</td>
            <td>${timeSlot}</td>
        `;

        tbody.appendChild(row);
    } else {
        alert('Please fill in all fields before adding!');
    }
});
        // AI button for clash detection (dummy function)
        function detectClashes() {
            alert('Clash detection feature coming soon!');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>