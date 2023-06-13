<!DOCTYPE html>
<html>
@extends('layouts.app')
@section('content')

<div class="container mt-5">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div id='calendar'></div>
</div>

<!-- New event Modal -->
@if(auth()->check())
    @if(auth()->user()->role_id==1)
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
                                <label for="eventDescription">Beschreibung</label>
                                <textarea name="description" id="eventDescription" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="eventDeadline">Map</label>
                                            <select class="form-control" id="eventMap" name="map_id">
                                                @foreach($maps as $map)
                                                    <option value="{{ $map->id }}">{{ $map->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="eventCost">Preis (CHF)</label>
                                        <input type="text" class="form-control" id="eventCost" name="cost">
                                    </div>
                                    <div class="form-group">
                                        <label for="eventFrom">Von</label>
                                        <input type="time" class="form-control" id="eventFrom" name="from">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventDeadline">Art</label>
                                        <select class="form-control" id="eventType" name="type">
                                            <option value="spiel">Spiel</option>
                                            <option value="training">Training</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="eventMeeting">Anz. Plätze</label>
                                        <input type="number" class="form-control" id="eventMaxPlayer" name="max_player">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="eventTo">Bis</label>
                                        <input type="time" class="form-control" id="eventTo" name="to">
                                    </div>
                                </div>
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
    @endif
@endif


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
                        <label for="eventDeadline" class="font-weight-bold">Beschreibung</label>
                        <p class="" id="eventDescription" name="description"></p>
                    </div>
                    @if(auth()->check())
                    @if(auth()->user()->role_id==1)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="eventDeadline" class="font-weight-bold">Map</label>
                                    <p class="card-text" id="eventMap" name="map_id"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="eventCost" class="font-weight-bold">Preis (CHF)</label>
                                <p type="text" class="card-text" id="eventCost" name="cost"></p>
                            </div>
                            <div class="form-group">
                                <label for="eventFrom" class="font-weight-bold">Von</label>
                                <p type="time" class="card-text" id="eventFrom" name="from"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventDeadline" class="font-weight-bold">Art</label>
                                <p class="card-text" id="eventType" name="from">Outdoor</p>
                            </div>
                            <div class="form-group">
                                <label for="eventMeeting" class="font-weight-bold">Anz. Plätze</label>
                                <p type="number" class="card-text" id="eventMaxPlayer" name="max_player"></p>
                            </div>
                            <div class="form-group">
                                <label for="eventTo" class="font-weight-bold">Bis</label>
                                <p type="time" class="card-text" id="eventTo" name="to"></p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                </form>
                
            </div>
            <div class="modal-footer">
                @if(auth()->check())
                    @if(auth()->user()->role_id==1)
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <button type="button" class="btn btn-primary" id="editEvent">Bearbeiten</button>
                        <button type="button" class="btn btn-danger" id="deleteEvent">Löschen</button>
                        <button type="button" class="btn btn-success" id="userEvent">Anmeldungen</button>

                    @elseif(auth()->user()->role_id==2 || auth()->user()->role_id==3)
                        @if(auth()->user()->verified == true)
                        <button type="button" class="btn btn-primary enroll-button" id="enroll">
                            Anmelden
                        </button>
                        @else
                            <p>Du bist nicht verifiziert</p>
                            <button type="button" class="btn btn-primary" id="enroll" disabled>
                                Anmelden
                            </button>     
                        @endif
                  @endif
                  @else
                  <p>Erstelle ein Konto</p>          
                  <button type="button" class="btn btn-primary" id="enroll" disabled>
                    Anmelden
                </button>         
                @endif
            </div>
        </div>
    </div>
</div>

<!-- User enrollment Modal -->
<div class="modal fade" id="userEnrollmentModal" tabindex="-1" role="dialog" aria-labelledby="userEnrollmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userEnrollmentModalLabel">Anmeldungen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Event --}}
<div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
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
                        <label for="eventDescription">Beschreibung</label>
                        <textarea name="description" id="eventDescription" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="eventDeadline">Map</label>
                                    <select class="form-control" id="eventMap" name="map_id">
                                        @foreach($maps as $map)
                                            <option value="{{ $map->id }}">{{ $map->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="eventCost">Preis (CHF)</label>
                                <input type="text" class="form-control" id="eventCost" name="cost">
                            </div>
                            <div class="form-group">
                                <label for="eventFrom">Von</label>
                                <input type="time" class="form-control" id="eventFrom" name="from">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="eventDeadline">Art</label>
                                <select class="form-control" id="eventType" name="type">
                                    <option value="spiel">Spiel</option>
                                    <option value="training">Training</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="eventMeeting">Anz. Plätze</label>
                                <input type="number" class="form-control" id="eventMaxPlayer" name="max_player">
                            </div>
                        
                            <div class="form-group">
                                <label for="eventTo">Bis</label>
                                <input type="time" class="form-control" id="eventTo" name="to">
                            </div>
                        </div>
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
                element.css('background-color', '#8ab586');

                element.css('border', '1px solid #8ab586');

                element.css('color', '#000000');

            },
            select: function (start, end, allDay) {
                $('#eventModal').modal('show');
                $('#eventModal').data('eventStart', start);

                $('#eventModal').find('.close').click(function () {
                    $('#eventModal').modal('hide');

                });
                $('#eventModal').find('.modal-footer .btn-secondary').click(function () {
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
                        cost: cost,
                        from: from,
                        to: to,
                        max_player: max_player,
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
                        $('#showEventModal').find('#eventModalLabel').text(response.title);
                        $('#showEventModal').find('#eventDescription').text(response.description);
                        $('#showEventModal').find('#eventMap').text(response.map.name);
                        $('#showEventModal').find('#eventType').text(response.type);
                        $('#showEventModal').find('#eventCost').text(response.cost);
                        $('#showEventModal').find('#eventFrom').text(response.from);
                        $('#showEventModal').find('#eventTo').text(response.to);
                        $('#showEventModal').find('#eventMaxPlayer').text(response.max_player);
                        $('#showEventModal').find('#enroll').click(function () {
                            var eventId = event.id;
                            var eventUrl = '{{ route("enroll", ":eventId") }}';
                            eventUrl = eventUrl.replace(':eventId', eventId);
                            window.location.href = eventUrl;
                        });
                        $('#showEventModal').modal('show');

                        if (response.type == 1) {
                            $('#showEventModal').find('#eventType').text('Outdoor');
                        } else {
                            $('#showEventModal').find('#eventType').text('Indoor');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });

                $('#showEventModal').find('.close').click(function () {
                    $('#showEventModal').modal('hide');
                });

                $('#showEventModal').find('.modal-footer .btn-secondary').click(function () {
                    $('#showEventModal').modal('hide');
                });

                $('#userEnrollmentModal').find('.modal-footer .btn-secondary').click(function () {
                    $('#userEnrollmentModal').modal('hide');
                });

                $('#editEventModal').find('.modal-footer .btn-secondary').click(function () {
                    $('#editEventModal').modal('hide');
                });

                $('#showEventModal').find('#userEvent').click(function () {
                    $('#showEventModal').modal('hide');
                    $('#userEnrollmentModal').modal('show');
                });

                $('#showEventModal').find('#editEvent').click(function () {
                    $('#showEventModal').modal('hide');
                    $('#editEventModal').modal('show');
                });
                // Delete

                function deleteEvent(event) {
                            var deleteMsg = confirm("Event wirklich löschen?");
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

                    $('#showEventModal').data('event', event); 
                    $('#deleteEvent').click(function () {
                        var event = $('#showEventModal').data('event');
                        deleteEvent(event);
                        $('#showEventModal').modal('hide');
                    });

            },


            firstDay: 1,

        });

        $('#saveEvent').click(function () {
            var title = $('#eventModal').find('#eventTitle').val();
            var description = $('#eventModal').find('#eventDescription').val();
            var cost = $('#eventModal').find('#eventCost').val();
            var from = $('#eventModal').find('#eventFrom').val();
            var to = $('#eventModal').find('#eventTo').val();
            var max_player = $('#eventModal').find('#eventMaxPlayer').val();
            var gameType = $('#eventModal').find('#eventType').val();
            var map_id = $('#eventModal').find('#eventMap').val();
            var start = $('#eventModal').data('eventStart');
            var end = moment(start).endOf('day');

            console.log(map_id);

            if (gameType === 'spiel') {
                gameType = 1;
            } else if (gameType === 'training') {
                gameType = 0;
            }
            $.ajax({
                url: SITEURL + "/fullcalenderAjax",
                data: {
                    title: title,
                    description: description,
                    cost: cost,
                    from: from,
                    to: to,
                    max_player: max_player,
                    gameType: gameType,
                    map_id: map_id,
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
                        from: from,
                        to: to,
                        max_player: max_player,
                        gameType: gameType,
                        start: start,
                        end: end,
                        allDay: true

                    }, true);

                    calendar.fullCalendar('unselect');
                }
            });

            $('#eventModal').modal('hide');
        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        }

    });
</script>

@endsection
