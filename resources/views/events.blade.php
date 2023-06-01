@extends('layouts.app')

@section('content')
<div class="container">
    <div id='calendar'></div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add event details -->
                <form id="eventForm">
                    <div class="form-group">
                        <label for="eventTitle">Event Title</label>
                        <input type="text" class="form-control" id="eventTitle" name="title">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEvent">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var SITEURL = "{{ url('/') }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: SITEURL + "/fullcalender",
        displayEventTime: false,
        editable: true,
        selectable: true,
        selectHelper: true,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        select: function (start, end, allDay) {
            // Open the Bootstrap Modal when a date is selected
            $('#eventModal').modal('show');
            $('#eventModal').data('eventStart', start); // Speichere den Startzeitpunkt im Modal
        },
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                data: {
                    title: event.title,
                    start: start,
                    end: end,
                    id: event.id,
                    type: 'update'
                },
                type: "POST",
                success: function (response) {
                    displayMessage("Event Updated Successfully");
                }
            });
        },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: SITEURL + '/fullcalenderAjax',
                    data: {
                        id: event.id,
                        type: 'delete'
                    },
                    success: function (response) {
                        calendar.fullCalendar('removeEvents', event.id);
                        displayMessage("Event Deleted Successfully");
                    }
                });
            }
        }
    });

    // Handle the click event of the Save button inside the modal
    $('#saveEvent').click(function () {
        var title = $('#eventModal').find('#eventTitle').val();
        var start = $('#eventModal').data('eventStart'); // Lade den Startzeitpunkt aus dem Modal
        var end = moment(start).endOf('day'); // Setze das Enddatum auf das Ende des Tages

        $.ajax({
            url: SITEURL + "/fullcalenderAjax",
            data: {
                title: title,
                start: start.format('YYYY-MM-DD'),
                end: end.format('YYYY-MM-DD'),
                type: 'add'
            },
            type: "POST",
            success: function (data) {
                displayMessage("Event Created Successfully");

                calendar.fullCalendar('renderEvent', {
                    id: data.id,
                    title: title,
                    start: start,
                    end: end,
                    allDay: true
                }, true);

                calendar.fullCalendar('unselect');
            }
        });

        // Hide the modal after saving
        $('#eventModal').modal('hide');
    });

    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
});

</script>
@endsection
