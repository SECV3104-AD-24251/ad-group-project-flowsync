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
        <h1>Lecturer Schedule Management</h1>

        <!-- Form for adding lecturer's timetable entries -->
        <div class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <select id="lecturerName" class="form-select">
                        <option value="">Select Lecturer</option>
                        <!-- Dynamically populate lecturers from database -->
                    </select>
                </div>

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

        <h3>Lecturer Timetable</h3>

        <!-- Display Timetable -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Lecturer Name</th>
                        <th>Course Code</th>
                        <th>Section</th>
                        <th>Time Slot</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="timetableBody">
                    <!-- Lecturer timetable entries will be populated here -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const timetableBody = document.getElementById('timetableBody');
        const addEntryBtn = document.getElementById('addEntryBtn');

        // Fetch lecturer names and timetable entries on page load
        fetch('/lecturers/get')
            .then(response => response.json())
            .then(data => {
                // Populate lecturer dropdown
                const lecturerSelect = document.getElementById('lecturerName');
                data.lecturers.forEach(lecturer => {
                    const option = document.createElement('option');
                    option.value = lecturer.id;
                    option.textContent = lecturer.name;
                    lecturerSelect.appendChild(option);
                });

                // Display timetable
                if (data.timetable.length === 0) {
                    timetableBody.innerHTML = ` 
                        <tr id="emptyRow">
                            <td colspan="5" class="text-center">No timetable entries yet.</td>
                        </tr>
                    `;
                } else {
                    timetableBody.innerHTML = '';
                    data.timetable.forEach(entry => {
                        const newRow = `
                            <tr>
                                <td>${entry.name}</td>
                                <td>${entry.course_code}</td>
                                <td>${entry.section}</td>
                                <td>${entry.time_slot}</td>
                                <td>
                                    <button class="btn btn-danger delete-btn" data-id="${entry.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        timetableBody.insertAdjacentHTML('beforeend', newRow);
                    });
                }
            });

        // Handle Add button click
        addEntryBtn.addEventListener('click', () => {
            const lecturerName = document.getElementById('lecturerName').value;
            const courseCode = document.getElementById('courseCode').value;
            const section = document.getElementById('section').value;
            const timeSlot = document.getElementById('timeSlot').value;

            if (!lecturerName || !courseCode || !section || !timeSlot) {
                Swal.fire('Error', 'Please fill in all fields.', 'error');
                return;
            }

            // Add timetable entry via AJAX
            fetch('/lecturers/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    name: lecturerName,
                    course_code: courseCode,
                    section: section,
                    time_slot: timeSlot
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success', 'Lecturer timetable entry added successfully!', 'success');
                    location.reload(); // Reload the page to reflect the new entry
                } else {
                    Swal.fire('Error', 'Failed to add timetable entry.', 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error', 'An error occurred while adding the entry.', 'error');
            });
        });

        // Handle Delete button click
        timetableBody.addEventListener('click', (e) => {
            if (e.target && e.target.classList.contains('delete-btn')) {
                const entryId = e.target.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will delete the timetable entry.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch(`/lecturers/delete/${entryId}`, { method: 'DELETE' })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Deleted!', 'The timetable entry has been deleted.', 'success');
                                    location.reload();
                                } else {
                                    Swal.fire('Error', 'Failed to delete the entry.', 'error');
                                }
                            })
                            .catch(error => Swal.fire('Error', 'An error occurred while deleting the entry.', 'error'));
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
