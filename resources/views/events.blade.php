<!DOCTYPE html>
<html>
@extends('layouts.app')
@section('content')

<div class="container-lg" style="margin: 50px 200px 100px 400px;">
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    @if(auth()->check())
    <div class="row">
        <div class="col-lg-9 order-1">
            <div id='calendar'></div>
        </div>
        <div class="col-lg-3 order-2" style="margin-top: 55px;">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Deine Anmeldungen</h5>
                    @foreach($eventData as $event)
                        <p class="card-text">{{$event}}</p>              
                    @endforeach
                </div>
            </div>
        </div>
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
                <button type="button" class="btn btn-success" id="userEvent">Anmeldungen</button>
                <button type="button" class="btn btn-primary" id="editEvent">Bearbeiten</button>
                <button type="button" class="btn btn-danger" id="deleteEvent">Löschen</button>

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
                <table class="table table-bordered" id="userList">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary">Zurück</button>
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
    var SITEURL = "{{ url('/') }}";
</script>

@vite('resources/js/event.js')

@endsection