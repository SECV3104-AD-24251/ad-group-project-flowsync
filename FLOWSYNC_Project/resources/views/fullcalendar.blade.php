<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Calendar</title>
    
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
            max-width: 500px;
            text-align: center;
            font-family: 'Arial', sans-serif;
            font-size: 16px;
        }

        .modal-footer {
            text-align: center;
            margin-top: 20px;
        }

        .btn-modal {
            padding: 10px 20px;
            margin: 10px 5px;
            background-color: #800000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-modal:hover {
            background-color: darkred;
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
    </style>
</head>

<body>
    <!-- Navigation Buttons -->
    <div class="nav-buttons">
        <a href="/student-dashboard" class="btn">&#8592; Back</a>
        <div>
            <a href="https://calendar.google.com/calendar/u/0/r?pli=1" target="_blank" class="btn">Google Calendar</a>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Student Calendar</h1>
    </div>

    <!-- Calendar -->
    <div id="calendar"></div>

    <!-- Modal for Event Details -->
    <div id="eventModal">
        <div id="modalContent">
            <h3>Event Details</h3>
            <p id="eventDetails"></p>
            <div class="modal-footer">
                <button id="okBtn" class="btn-modal">OK</button>
                <button id="deleteBtn" class="btn-modal">Delete</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/events', // Fetch events from the database
                selectable: true,
                editable: true,
                eventDisplay: 'block',
                eventContent: function(arg) {
                    return { html: `<div class="fc-event-title">${arg.event.title}</div>` };
                },
                select: function(info) {
                    var title = prompt('Enter Event Title:');
                    if (title) {
                        $.ajax({
                            url: '/events',
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
                eventClick: function(info) {
                    var eventDetails = `
                        <strong>Title:</strong> ${info.event.title} <br>
                        <strong>Description:</strong> ${info.event.extendedProps.description || 'No description available'}
                    `;

                    $('#eventDetails').html(eventDetails);
                    $('#eventModal').show();

                    $('#okBtn').click(function() {
                        $('#eventModal').hide();
                    });

                    $('#deleteBtn').click(function() {
                        $.ajax({
                            url: `/events/${info.event.id}`,
                            method: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function() {
                                calendar.refetchEvents();
                                alert('Event deleted successfully');
                                $('#eventModal').hide();
                            },
                            error: function() {
                                alert('Failed to delete event');
                            }
                        });
                    });
                }
            });

            calendar.render();
        });
    </script>
</body>
</html>
