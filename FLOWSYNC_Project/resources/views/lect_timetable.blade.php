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

        .ai-button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .ai-button {
            background-color: #800000;
            border: none;
            border-radius: 50%;
            padding: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .ai-button img {
            width: 50px;
            height: 50px;
        }

        .ai-button:hover {
            transform: scale(1.1);
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.3);
        }

        /* Main container */
        .main-container {
            width: 80%;
            margin: 30px auto;
        }

        /* lecturer Info Section */
        .lecturer-info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            font-size: 16px;
        }

        .lecturer-info .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .lecturer-info .details div {
            width: 48%; /* For two columns */
        }

        .lecturer-info .details span {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Back Button -->
    <a href="/lecturer-dashboard" class="back-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
        </svg>
        <span>Back</span>
    </a>

    <div class="container mt-5">
        <h1>Lecturer Schedule Management</h1>

        <div class="main-container">
            <!-- Lecturer Info Section -->
            <div class="lecturer-info">
                <div class="details">
                    <div>
                        <p><span>Name:</span> Dr. Zulaikha</p>
                        <p><span>Email:</span> zulaikha@utm.edu.my</p>
                    </div>
                    <div>
                        <p><span>Phone:</span> +6019 7645634</p>
                    </div>
                </div>
                <div class="details">
                    <div>
                        <p><span>Status:</span> Active</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form for adding lecturer's timetable entries -->
        <div class="mb-4">
            <div class="row g-2">
                <div class="col-md-2">
                    <select id="courseName" class="form-select">
                        <option value="">Select Course</option>
                        <option value="Artificial Intelligence">SECJ3553 Artificial Intelligence</option>
                        <option value="Application Development">SECV3104 Application Development</option>
                        <option value="Geometry Modelling">SECV3113 Geometric Modelling</option>
                        <option value="Fundamental of Image Processing">SECV3213 Fundamental of Image Processing</option>
                        <option value="Professional Communication Skills 2">UHLB3132 Professional Communication Skills 2</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select id="section" class="form-select">
                        <option value="">Select Section</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="ALL">ALL</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select id="timeSlot" class="form-select">
                        <option value="">Select Time Slot</option>
                        <option value="SUN 11:00-13:00">SUN 11:00-13:00</option>
                        <option value="MON 8:00-10:00">MON 8:00-10:00</option>
                        <option value="TUE 8:00-10:00">TUE 8:00-10:00</option>
                        <option value="WED 10:00-13:00">WED 10:00-13:00</option>
                        <option value="THU 8:00-11:00">THU 8:00-11:00</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select id="room" class="form-select">
                        <option value="">Select Room</option>
                        <option value="Room A">Room A</option>
                        <option value="Room B">Room B</option>
                        <option value="Room C">Room C</option>
                        <option value="Room D">Room D</option>
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
                        <th>Course Name</th>
                        <th>Section</th>
                        <th>Time Slot</th>
                        <th>Room</th>
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

                    // Populate course dropdown
                    const courseSelect = document.getElementById('courseName');
                    data.courses.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course.id;
                        option.textContent = course.name;
                        courseSelect.appendChild(option);
                    });

                    // Display timetable
                    if (data.timetable.length === 0) {
                        timetableBody.innerHTML = ` 
                            <tr id="emptyRow">
                                <td colspan="6" class="text-center">No timetable entries yet.</td>
                            </tr>
                        `;
                    } else {
                        timetableBody.innerHTML = '';
                        data.timetable.forEach(entry => {
                            const newRow = `
                                <tr>
                                    <td>${entry.name}</td>
                                    <td>${entry.course_name}</td>
                                    <td>${entry.section}</td>
                                    <td>${entry.time_slot}</td>
                                    <td>${entry.room}</td>
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
                const lecturerName = "Dr. Zulaikha"; // Update this with a default or dynamically fetched lecturer name
                const courseName = document.getElementById('courseName').value;
                const section = document.getElementById('section').value;
                const timeSlot = document.getElementById('timeSlot').value;
                const room = document.getElementById('room').value;

                if (!lecturerName || !courseName || !section || !timeSlot || !room) {
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
                        lecturer_name: lecturerName,
                        course_name: courseName,
                        section: section,
                        time_slot: timeSlot,
                        room: room
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Success', data.message, 'success');
                        location.reload(); // Reload the page to reflect the new entry
                    } else {
                        Swal.fire('Error', data.message, 'error');
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
                        text: 'This will permanently delete the entry.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, keep it'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/lecturers/delete/${entryId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Deleted!', 'The timetable entry has been deleted.', 'success');
                                    location.reload(); // Reload the page to reflect the deletion
                                } else {
                                    Swal.fire('Error', 'Failed to delete timetable entry.', 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error', 'An error occurred while deleting the entry.', 'error');
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
