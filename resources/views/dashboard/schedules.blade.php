<x-app-layout>
    <div class="container py-4">
        <h2 class="header-title font-semibold text-gray-700 mb-6">Transplant Schedules Calendar</h2>

        <div id="calendar"></div>
    </div>

    <!-- FullCalendar CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet" />
    <style>
    .fc .fc-button, 
    .fc .fc-button-primary, 
    .fc .fc-button-active, 
    .fc .fc-button:focus, 
    .fc .fc-button:active {
        background-color: #9c0f3f !important;
        border-color: #9c0f3f !important;
        color: #fff !important;
        box-shadow: none !important;
        text-transform: capitalize !important;
        letter-spacing: normal !important;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <script>
        const events = @json($recipients->map(function($r) {
            return [
                'title' => $r->first_name . ' ' . $r->last_name,
                'start' => $r->scheduled_transplant_date . ($r->transplantation_time ? 'T' . $r->transplantation_time : ''),
            ];
        }));

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: events,
                height: 650,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: 'short'
                },
            });
            calendar.render();
        });
    </script>
</x-app-layout> 