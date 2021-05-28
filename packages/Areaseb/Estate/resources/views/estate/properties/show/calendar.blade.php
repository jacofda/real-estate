@if($property->calendar)
    <div class="card collapsed-card">
        <div class="card-header">
            <h3 class="card-title">Bookings</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                <a title="crea prenotazione" href="{{route('bookings.create')}}?property_id={{$property->id}}" class="btn btn-primary btn-xxs"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="calendar" style="width: 100%"></div>
        </div>
    </div>

    @include('estate::estate.properties.show.booking')



@push('scripts')
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('calendar/js/app.js')}}"></script>

<script>

$(function () {
    moment.locale('it');
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'it',
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
        themeSystem: 'bootstrap',
        events: "{{url('api/calendars/'.$property->calendar->id.'/events')}}",
        eventClick: function(info) {
            showModal(info.event.id)
        }

    });
    calendar.render();
});
</script>
@endpush

@endif
