<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lecturer Calendar</title>

    <!-- FullCalendar CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom Styles -->
    <style>
        /* Body Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Header Section */
        .header {
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 0 0 5px 5px;
        }

        .header h1 {
            margin: 0;
            font-size: 2.8rem;
            font-weight: bold;
            color: maroon;
            letter-spacing: 1px;
        }

        /* Navigation Buttons */
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 10px;
            border-radius: 0 0 10px 10px;
        }

        .btn {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #800000;
            color: white;
            border-radius: 30px;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, background-color 0.2s;
        }

        .btn:hover {
            background-color: darkred;
            transform: translateY(-2px);
        }

        /* Calendar Styles */
        #calendar {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1450px;
            margin: 0 auto;
            font-family: 'Arial', sans-serif;
            font-size: 15px;
        }

        /* Event Styling */
        .fc-event-title {
            background-color: maroon !important;
            color: white !important;
            padding: 5px;
            border-radius: 3px;
            text-align: center;
        }

        .fc-event, .fc-daygrid-event {
            background-color: maroon !important;
            color: white !important;
            border: none !important;
            border-radius: 5px;
        }

        /* Modal Styling */
        #eventModal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            padding-top: 60px;
        }

        #modalContent {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            text-align: left;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        #modalContent h3 {
            text-align: center;
            margin-bottom: 35px;
            font-size: 1.8rem;
            color: maroon;
        }

        .modal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0;
        }

        .modal-row label {
            flex: 1;
            font-weight: bold;
            color: #333;
            margin-right: 15px;
        }

        .modal-row input,
        
        .modal-row textarea {
            flex: 2;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .modal-row span {
            flex: 2;
            background-color: #f7f7f7;
            padding: 8px;
            border-radius: 5px;
        }

        .modal-row select {
            flex: 2;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            resize: none;
        }

        .modal-footer {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .btn-modal {
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: #800000;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-modal:hover {
            background-color: darkred;
            transform: scale(1.05);
        }

        #eventDisplay .modal-row span {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-buttons {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            #calendar {
                padding: 15px;
                font-size: 14px;
            }
        }

        /* Popup */
        #popup {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #800000;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            font-weight: bold;
            display: none;
            z-index: 1000;
        }

        #popup.show {
            display: block;
            animation: fadeInOut 5s ease-in-out;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(20px); }
            10%, 90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(20px); }
        }

        /* Notification Popup */
        #popupNotification {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #800000;
            color: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        #popupNotification button {
            background-color: white;
            color: #800000;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #popupNotification button:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <!-- Navigation Buttons -->
    <div class="nav-buttons">
        <a href="/lecturer-dashboard" class="btn">&#8592; Back</a>
        <div>
            <a href="https://calendar.google.com/calendar/u/0/r?pli=1" target="_blank" class="btn">Google Calendar</a>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Lecturer Calendar</h1>
    </div>

    <!-- Calendar -->
    <div id="calendar"></div>

    <!-- Popup -->
    <div id="popup"></div>

    <!-- Notification -->
    <div id="popupNotification">
        <p id="notificationText"></p>
        <button id="closeNotification">Dismiss</button>
    </div>

    <!-- Modal for Event Details -->
    <div id="eventModal">
        <div id="modalContent">
            <h3>Event Details</h3>
            
            <!-- Event Display Mode -->
            <div id="eventDisplay">
                <div class="modal-row"><strong>Title:</strong> <span id="eventTitle"></span></div>
                <div class="modal-row"><strong>Description:</strong> <span id="eventDescription"></span></div>
                <div class="modal-row"><strong>Date:</strong> <span id="eventDate"></span></div>
                <div class="modal-row"><strong>Time:</strong> <span id="eventTime"></span></div>
                <div class="modal-row"><strong>Location:</strong> <span id="eventLocation"></span></div>
            </div>

            <!-- Event Edit Mode -->
            <form id="eventEditForm" style="display: none;">
                <div class="modal-row">
                    <label for="editTitle">Title:</label>
                    <input type="text" id="editTitle" name="editTitle" required>
                </div>
                <div class="modal-row">
                    <label for="editDescription">Description:</label>
                    <textarea id="editDescription" name="editDescription" rows="3"></textarea>
                </div>
                <div class="modal-row">
                    <label for="editDate">Date:</label>
                    <input type="date" id="editDate" name="editDate" required>
                </div>
                <div class="modal-row">
                    <label for="editTime">Time:</label>
                    <input type="time" id="editTime" name="editTime" required>
                </div>
                <div class="modal-row">
                    <label for="editLocation">Location:</label>
                    <input type="text" id="editLocation" name="editLocation">
                </div>
                <div class="modal-row">
                    <label for="editNotification">Notification:</label>
                    <select id="editNotification" name="editNotification">
                        <option value="none">No Notification</option>
                        <option value="5">5 Minutes Before</option>
                        <option value="10">10 Minutes Before</option>
                        <option value="15">15 Minutes Before</option>
                        <option value="30">30 Minutes Before</option>
                        <option value="60">1 Hour Before</option>
                    </select>
                </div>
            </form>

            <!-- Buttons -->
            <div class="modal-footer">
                <button id="editBtn" class="btn-modal">Edit</button>
                <button id="saveBtn" class="btn-modal" style="display: none;">Save</button>
                <button id="cancelEditBtn" class="btn-modal" style="display: none;">Cancel</button>
                <button id="deleteBtn" class="btn-modal">Delete</button>
                <button id="okBtn" class="btn-modal">OK</button>
            </div>
        </div>
    </div>

    <script>
        // Function to show popup notification
        function showNotification(message, type = 'success') {
            var popup = document.getElementById('popup');
            popup.textContent = message;
            popup.style.backgroundColor = type === 'error' ? 'darkred' : '#800000';
            popup.classList.add('show');
            setTimeout(() => {
                popup.classList.remove('show');
            }, 5000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var popupNotification = document.getElementById('popupNotification');
            var notificationText = document.getElementById('notificationText');

            // Close notification button functionality
            document.getElementById('closeNotification').addEventListener('click', function () {
                popupNotification.style.display = 'none';
            });

            // Initialize FullCalendar
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/lect_event', // Fetch events from the database
                selectable: true,
                editable: true,
                eventTimeFormat: { hour: '2-digit', minute: '2-digit', meridiem: true },
                select: function(info) {
                    var title = prompt('Enter Event Title:');
                    if (title) {
                        $.ajax({
                            url: '/lect_event',
                            method: 'POST',
                            data: {
                                title: title,
                                start: info.startStr,
                                end: info.endStr,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                calendar.refetchEvents();
                                alert('Event added successfully');
                            },
                            error: function() {
                                alert('Failed to add event');
                            }
                        });
                    }
                },
                eventClick: function (info) {
                    var event = info.event;

                    // Display event details
                    $('#eventTitle').text(event.title);
                    $('#eventDescription').text(event.extendedProps.description || 'No description available');
                    $('#eventDate').text(event.start.toLocaleDateString());
                    $('#eventTime').text(event.start.toLocaleTimeString());
                    $('#eventLocation').text(event.extendedProps.location || 'Not specified');

                    // Show modal
                    $('#eventModal').show();

                    // Edit button
                    $('#editBtn').off('click').click(function () {
                        $('#eventDisplay').hide();
                        $('#eventEditForm').show();

                        // Prefill form values
                        $('#editTitle').val(event.title);
                        $('#editDescription').val(event.extendedProps.description || '');
                        $('#editDate').val(event.start.toISOString().split('T')[0]);
                        $('#editTime').val(event.start.toISOString().split('T')[1].slice(0, 5));
                        $('#editLocation').val(event.extendedProps.location || '');

                        $('#saveBtn, #cancelEditBtn').show();
                        $('#editBtn').hide();
                    });

                    // Save button
                    $('#saveBtn').off('click').click(function () {
                        var updatedTitle = $('#editTitle').val();
                        var updatedDescription = $('#editDescription').val();
                        var updatedDate = $('#editDate').val();
                        var updatedTime = $('#editTime').val();
                        var updatedLocation = $('#editLocation').val();
                        var updatedStart = updatedDate + 'T' + updatedTime;

                        $.ajax({
                            url: '/lect_event/' + event.id,
                            method: 'PUT',
                            data: {
                                title: updatedTitle,
                                description: updatedDescription,
                                start: updatedStart,
                                location: updatedLocation,
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function () {
                                calendar.refetchEvents();
                                showNotification('Event updated successfully!');
                                alert('Event updated successfully');
                                $('#eventModal').hide();
                            },
                            error: function () {
                                showNotification('Failed to update event.', 'error');
                                alert('Failed to update event');
                            },
                        });
                    });

                    // Cancel Edit button
                    $('#cancelEditBtn').off('click').click(function () {
                        $('#eventEditForm').hide();
                        $('#eventDisplay').show();
                        $('#saveBtn').hide();
                        $('#cancelEditBtn').hide();
                        $('#editBtn').show();
                    });

                    // Handle OK Button
                    $('#okBtn').off('click').click(function () {
                        $('#eventModal').hide();
                    });

                    // Delete button
                    $('#deleteBtn').off('click').click(function () {
                        $.ajax({
                            url: '/lect_event/' + event.id,
                            method: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                            },
                            success: function () {
                                calendar.refetchEvents();
                                alert('Event deleted successfully');
                                $('#eventModal').hide();
                            },
                            error: function () {
                                alert('Failed to delete event');
                            },
                        });
                    });
                },

            });

            calendar.render();

            // Periodically check for upcoming events
            setInterval(function () {
                var now = new Date();
                calendar.getEvents().forEach(function (event) {
                    var eventStart = new Date(event.start);
                    var timeDifference = (eventStart - now) / 1000 / 60; // Time difference in minutes

                    if (timeDifference > 0 && timeDifference <= 10) { // Within 10 minutes
                        notificationText.textContent = `Upcoming Event: "${event.title}" at ${eventStart.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;
                        popupNotification.style.display = 'block';
                    }
                });
            }, 60000); // Check every minute
        });
    </script>
</body>
</html>
