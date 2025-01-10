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
                        <option value="SECJ3553">SECJ3553</option>
                        <option value="SECV3104">SECV3104</option>
                        <option value="SECV3113">SECV3113</option>
                        <option value="SECV3213">SECV3213</option>
                        <option value="UHLB3132">UHLB3132</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="courseName" class="form-select">
                        <option value="">Select Course Name</option>
                        <option value="Artificial Intelligence">Artificial Intelligence</option>
                        <option value="Application Development">Application Development</option>
                        <option value="Geometry Modelling">Geometric Modelling</option>
                        <option value="Fundamental of Image Processing">Fundamental of Image Processing</option>
                        <option value="Professional Communication Skills 2">Professional Communication Skills 2</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select id="section" class="form-select">
                        <option value="">Select Section</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="ALL">ALL</option>
                    </select>

                </div>

                <div class="col-md-3">
                    <select id="timeSlot" class="form-select">
                        <option value="">Select Time Slot</option>
                        <option value="SUN 11:00-13:00">SUN 11:00-13:00</option>
                        <option value="MON 8:00-10:00">MON 8:00-10:00</option>
                        <option value="MON 10:00-13:00">MON 10:00-13:00</option>
                        <option value="TUE 8:00-10:00">TUE 8:00-10:00</option>
                        <option value="WED 10:00-13:00">WED 10:00-13:00</option>
                        <option value="THU 8:00-11:00">THU 8:00-11:00</option>
                    </select>
                </div>
            </div>

            <!-- Add button -->
            <div class="d-flex justify-content-end mt-3">
                <button id="addEntryBtn" class="btn btn-primary mb-3">Add</button>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="timetableBody">
                    <!-- Timetable entries will be populated here via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- AI Assistant Button -->
    <div class="ai-button-container">
        <button class="ai-button">
            <img src="https://via.placeholder.com/50" alt="AI Icon" />
        </button>
    </div>
    <div class="ai-button-container">
    <button class="ai-button" id="aiButton">
        <img src="https://cdn-icons-png.flaticon.com/512/3079/3079021.png" alt="AI Button">
    </button>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const timetableBody = document.getElementById('timetableBody');

        // Event delegation for delete buttons
        timetableBody.addEventListener('click', (event) => {
            if (event.target.classList.contains('delete-btn')) {
                handleDeleteButtonClick(event);
            }
        });

        function handleDeleteButtonClick(event) {
            const row = event.target.closest('tr'); // Get the closest row
            const courseCode = row.cells[0].innerText; // Get course code from the row
            const courseName = row.cells[1].innerText; // Get course name from the row
            const section = row.cells[2].innerText; // Get section from the row
            const timeSlot = row.cells[3].innerText; // Get time slot from the row

            // Confirm deletion
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete the entry for ${courseName} (${courseCode}) in section ${section} during ${timeSlot}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send DELETE request to the server
                    fetch('/timetable/delete', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            course_code: courseCode,
                            course_name: courseName,
                            section: section,
                            time_slot: timeSlot
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            Swal.fire('Deleted!', 'The timetable entry has been deleted.', 'success');
                            // Remove the row from the table
                            row.remove();
                        } else {
                            Swal.fire('Error', 'Failed to delete the timetable entry.', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Failed to delete the timetable entry.', 'error');
                    });
                }
            });
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const timetableBody = document.getElementById('timetableBody');
        const addEntryBtn = document.getElementById('addEntryBtn');
        const aiButton = document.getElementById('aiButton');

        // Fetch timetable entries on page load
        fetch('/timetable/get')
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    timetableBody.innerHTML = `
                        <tr id="emptyRow">
                            <td colspan="5" class="text-center">No timetable entries yet.</td>
                        </tr>
                    `;
                } else {
                    timetableBody.innerHTML = ''; // Clear the empty row
                    data.forEach(entry => {
                        const newRow = `
                            <tr>
                                <td>${entry.course_code}</td>
                                <td>${entry.course_name}</td>
                                <td>${entry.section}</td>
                                <td>${entry.time_slot}</td>
                                <td><button class="btn btn-danger delete-btn">Delete</button></td>
                            </tr>
                        `;
                        timetableBody.insertAdjacentHTML('beforeend', newRow);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching timetable entries:', error);
            });

        // Handle Add Button
        addEntryBtn.addEventListener('click', () => {
            const courseCode = document.getElementById('courseCode').value;
            const courseName = document.getElementById('courseName').value;
            const section = document.getElementById('section').value;
            const timeSlot = document.getElementById('timeSlot').value;

            // Validate inputs
            if (!courseCode || !courseName || !section || !timeSlot) {
                Swal.fire('Error', 'Please fill in all fields.', 'error');
                return;
            }

            // Check for clashes in the current table
            const rows = Array.from(timetableBody.rows);
            const isClashing = rows.some(row => {
                const rowSection = row.cells[2].innerText.trim();
                const rowTimeSlot = row.cells[3].innerText.trim();
                return rowSection === section && rowTimeSlot === timeSlot;
            });

            if (isClashing) {
                Swal.fire({
                    title: 'Clash Detected',
                    text: 'A course is already scheduled in this time slot and section.',
                    icon: 'error',
                    confirmButtonText: 'Okay',
                });
                return;
            }

            // Send data via AJAX to store it in the database
            fetch('/timetable/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    course_code: courseCode,
                    course_name: courseName,
                    section: section,
                    time_slot: timeSlot,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    Swal.fire('Success', 'Course added to timetable.', 'success');
                    // Add new row to the table
                    const newRow = `
                        <tr>
                            <td>${courseCode}</td>
                            <td>${courseName}</td>
                            <td>${section}</td>
                            <td>${timeSlot}</td>
                            <td><button class="btn btn-danger delete-btn">Delete</button></td>
                        </tr>
                    `;
                    timetableBody.insertAdjacentHTML('beforeend', newRow);
                }
            })
            .catch(error => {
                Swal.fire('Error', 'Failed to add timetable entry.', 'error');
            });

            // Reset select inputs
            document.getElementById('courseCode').value = '';
            document.getElementById('courseName').value = '';
            document.getElementById('section').value = '';
            document.getElementById('timeSlot').value = '';
        });

        // AI Button for Clash Detection
        aiButton.addEventListener('click', () => {
            const rows = Array.from(timetableBody.rows);
            const seen = {};
            const conflicts = [];

            rows.forEach((row, index) => {
                const section = row.cells[2].innerText.trim();
                const timeSlot = row.cells[3].innerText.trim();
                const key = `${section}-${timeSlot}`;

                if (seen[key]) {
                    conflicts.push({
                        course1: seen[key].courseName,
                        course2: row.cells[1].innerText.trim(),
                        section,
                        timeSlot,
                    });

                    // Highlight conflicting rows
                    row.setAttribute('data-clash', 'true');
                    rows[seen[key].index].setAttribute('data-clash', 'true');
                } else {
                    seen[key] = {
                        courseName: row.cells[1].innerText.trim(),
                        index,
                    };
                    row.removeAttribute('data-clash');
                }
            });

            // Show conflicts if any
            if (conflicts.length > 0) {
                let conflictDetails = '';
                conflicts.forEach((conflict, i) => {
                    conflictDetails += `
                        <b>${i + 1}.</b> <u>Clash:</u> 
                        <b>Courses:</b> ${conflict.course1} and ${conflict.course2}<br>
                        <b>Time Slot:</b> ${conflict.timeSlot} <br>
                        <b>Section:</b> ${conflict.section}<br><br>
                    `;
                });

                Swal.fire({
                    title: 'Schedule Conflicts Found!',
                    html: conflictDetails,
                    icon: 'warning',
                    confirmButtonText: 'Okay',
                });
            } else {
                Swal.fire('No Conflicts', 'Your schedule is conflict-free.', 'success');
            }
        });
    });
        
    document.getElementById('aiButton').addEventListener('click', () => {
    // Get all rows from the timetable
    const rows = document.querySelectorAll('#timetableBody tr');
    const conflicts = [];
    const seen = {};

    // Check for conflicts
    rows.forEach((row, index) => {
        const cells = row.children;
        const section = cells[2].innerText.trim();
        const timeSlot = cells[3].innerText.trim();

        const key = `${section}-${timeSlot}`;
        if (seen[key]) {
            // Conflict detected
            conflicts.push({
                course1: seen[key].course,
                course2: cells[1].innerText.trim(),
                timeSlot,
                section,
            });

            // Highlight the conflicting rows
            row.setAttribute('data-clash', 'true');
            rows[seen[key].index].setAttribute('data-clash', 'true');
        } else {
            seen[key] = {
                course: cells[1].innerText.trim(),
                index,
            };
            row.removeAttribute('data-clash');
        }
    });

    // Show popup if conflicts exist
    if (conflicts.length > 0) {
        let conflictDetails = '';
        conflicts.forEach((conflict, i) => {
            conflictDetails += `<b>${i + 1}.</b> <u>Clash:</u> 
            <br> <b>Courses:</b> ${conflict.course1} and ${conflict.course2}
            <br> <b>Time Slot:</b> ${conflict.timeSlot} 
            <br> <b>Section:</b> ${conflict.section}<br><br>`;
        });

        Swal.fire({
            title: 'Schedule Conflicts Found!',
            html: conflictDetails,
            icon: 'warning',
            confirmButtonText: 'Okay',
        });
    } else {
        Swal.fire('No Conflicts', 'Your schedule is conflict-free.', 'success');
    }
});

    </script>

</body>
</html>
