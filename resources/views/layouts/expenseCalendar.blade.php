<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Coinwise - Transaction Calendar</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/23c9e34443.js" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 250px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        @include('sidebar')
    </div>

    <div class="content">
        <div id="calendar"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'Indonesia/Malang',
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'timeGridWeek,timeGridDay',
                    center: 'title',
                    right: 'prev,next'
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                },
                events: @json($events),
                eventClick: function (info) {
                    alert('Transaction amount: ' + info.event.extendedProps.amount);
                }
            });
            calendar.render();
        });
    </script>
</body>

</html>