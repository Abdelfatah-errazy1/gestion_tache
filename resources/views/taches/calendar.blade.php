@extends('layouts.layouts')

@section('content')
<div class="container">
    <h2>📅 Task Deadlines Calendar</h2>
    <div id='calendar'></div>
</div>
@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    if (!calendarEl) {
        console.error("Calendar element not found.");
        return;
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events: '{{ route('calendar.events') }}',
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            console.log(info);
            
            if (info.event.url) {
                window.open(info.event.url, "_blank");
            }
        }
    });

    calendar.render();
});
</script>
@endsection
