<!DOCTYPE html>
<html>
<head>
    <title>Laravel FullCalendar</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/events', // Fetch events from the database
                selectable: true,
                editable: true,
                select: function (info) {
                    var title = prompt('Enter Event Title:');
                    if (title) {
                        $.ajax({
                            url: '/events',
                            method: 'POST',
                            data: {
                                title: title,
                                start: info.startStr,
                                end: info.endStr,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                calendar.refetchEvents();
                                alert('Event added successfully');
                            }
                        });
                    }
                }
            });

            calendar.render();
        });
    </script>
</body>
</html>
