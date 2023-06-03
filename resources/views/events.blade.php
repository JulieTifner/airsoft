@extends('layouts.app')

@section('content')
<div class="container">
    <div id='calendar'></div>
</div>

<!-- New event Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event Erfassen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="form-group">
                        <label for="eventTitle">Titel</label>
                        <input type="text" class="form-control" id="eventTitle" name="title">
                    </div>
                    <div class="form-group">
                        <label for="eventTitle">Beschreibung</label>
                        <input type="text" class="form-control" id="eventDescription" name="description">
                    </div>
                    <div class="form-group">
                        <label for="eventTitle">Preis</label>
                        <input type="text" class="form-control" id="eventCost" name="cost">
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


<!-- Show event Modal -->
<div class="modal fade" id="showEventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="form-group">
                        <label for="eventTitle">Titel</label>
                        <input type="text" class="form-control" id="eventTitle" name="title">
                    </div>
                    <div class="form-group">
                        <label for="eventTitle">Beschreibung</label>
                        <input type="text" class="form-control" id="eventDescription" name="description">
                    </div>
                    <div class="form-group">
                        <label for="eventTitle">Preis</label>
                        <input type="text" class="form-control" id="eventCost" name="cost">
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
        events: SITEURL + "/events",
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

            $('#eventModal').find('.close').click(function() {
                $('#eventModal').modal('hide');
                
            });
            $('#eventModal').find('.modal-footer .btn-secondary').click(function() {
                $('#eventModal').modal('hide');
            });
        },
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

            $.ajax({
                url: SITEURL + '/fullcalenderAjax',
                data: {
                    title: event.title,
                    description: event.description,       
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
            
            $.ajax({
            url: SITEURL + '/event',
            data: {
                eventId: event.id
            },
            type: 'GET',
            success: function (response) {
                $('#showEventModal').find('#eventTitle').val(response.title);
                $('#showEventModal').find('#eventDescription').val(response.description);
                $('#showEventModal').find('#eventCost').val(response.cost);

                $('#showEventModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });

            $('#showEventModal').find('.close').click(function() {
                    $('#showEventModal').modal('hide');
                    
                });
                $('#showEventModal').find('.modal-footer .btn-secondary').click(function() {
                    $('#showEventModal').modal('hide');
                });
            },
        //     var deleteMsg = confirm("Do you really want to delete?");
        //     if (deleteMsg) {
        //         $.ajax({
        //             type: "POST",
        //             url: SITEURL + '/fullcalenderAjax',
        //             data: {
        //                 id: event.id,
        //                 type: 'delete'
        //             },
        //             success: function (response) {
        //                 calendar.fullCalendar('removeEvents', event.id);
        //                 displayMessage("Event Deleted Successfully");
        //             }
        //         });
        //     }
        // }
    });

    // Handle the click event of the Save button inside the modal
    $('#saveEvent').click(function () {
        var title = $('#eventModal').find('#eventTitle').val();
        var description = $('#eventModal').find('#eventDescription').val();
        var cost = $('#eventModal').find('#eventCost').val();
        var start = $('#eventModal').data('eventStart'); // Lade den Startzeitpunkt aus dem Modal
        var end = moment(start).endOf('day'); // Setze das Enddatum auf das Ende des Tages

        $.ajax({
            url: SITEURL + "/fullcalenderAjax",
            data: {
                title: title,
                description: description,
                cost: cost,
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
                    description: description,
                    cost: cost,
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
