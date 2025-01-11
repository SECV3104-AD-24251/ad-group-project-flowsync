<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel FullCalendar Integration</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Add custom CSS to change event title background to maroon and text color to white -->
    <style>
        .fc-title {
            background-color: maroon !important; /* Set background color to maroon */
            color: white !important;  /* Set text color to white */
            padding: 5px; /* Add padding to improve visibility */
            border-radius: 3px; /* Optional: Add rounded corners for a better look */
        }

        /* Modal styles */
        #eventModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        #modalContent {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .btn {
            padding: 10px 20px;
            margin: 5px;
            background-color: maroon;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: darkred;
        }

        .modal-footer {
            text-align: center;
        }
    </style>
</head>
<body>

    <div id="calendar"></div>

    <!-- Modal for event actions -->
    <div id="eventModal">
        <div id="modalContent">
            <h3>Event Details</h3>
            <p id="eventDetails"></p>
            <div class="modal-footer">
                <button id="okBtn" class="btn">OK</button>
                <button id="deleteBtn" class="btn">Delete</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/events', // Fetch events from the database (GET request)
                selectable: true,
                editable: true,
                eventDisplay: 'block', // Ensure the events are displayed without the time
                eventContent: function(arg) {
                    // Customizing event content to only show the title, not the time
                    return { html: `<div class="fc-title">${arg.event.title}</div>` };
                },
                select: function (info) {
                    // Prompt for a new event title only
                    var title = prompt('Enter Event Title:');
                    if (title) {
                        $.ajax({
                            url: '/events', // POST request to create a new event
                            method: 'POST',
                            data: {
                                title: title,
                                start: info.startStr,
                                end: info.endStr,
                                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                            },
                            success: function (response) {
                                calendar.refetchEvents(); // Reload events on success
                                alert('Event added successfully');
                            },
                            error: function () {
                                alert('Failed to add event');
                            }
                        });
                    }
                },
                eventClick: function (info) {
                    // Show event details (title, description)
                    var eventDetails = `
                         <strong>Title:</strong> ${info.event.title} <br>
                         <strong>Description:</strong> ${info.event.extendedProps.description || 'No description available'} <br>
                         
                    `;

                    // Populate the modal with event details
                    $('#eventDetails').html(eventDetails);

                    // Show the modal
                    $('#eventModal').show();

                    // OK button to close the modal
                    $('#okBtn').click(function() {
                        $('#eventModal').hide();
                    });

                    // Delete button to delete the event
                    $('#deleteBtn').click(function() {
                        // Send DELETE request to server to delete the event from the database
                        $.ajax({
                            url: `/events/${info.event.id}`, // DELETE request to remove event
                            method: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                            },
                            success: function () {
                                // Remove the event from FullCalendar view
                                calendar.refetchEvents();
                                alert('Event deleted successfully');
                                $('#eventModal').hide(); // Close the modal
                            },
                            error: function () {
                                alert('Failed to delete event');
                            }
                        });
                    });
                }
            });

            calendar.render(); // Render the calendar
        });
    </script>

</body>
</html>
