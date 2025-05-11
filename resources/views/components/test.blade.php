<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FullCalendar Global Working</title>

    <!-- ✅ FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

    <style>
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Calendar Fixed Example</h2>
<div id="calendar"></div>

<!-- ✅ USE THIS GLOBAL VERSION -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                {
                    title: 'Example Task',
                    start: new Date().toISOString().split('T')[0]
                }
            ]
        });

        calendar.render();
    });
</script>

</body>
</html>
