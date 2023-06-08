@extends('layouts.app')

@section('content')

<div class="container" style=" width: 1000px;">
    <div class="card w-75">
        <div class="card-body">
            <h3 class="card-title pb-2">{{ $event->title }}</h3>
            <form id="eventForm">
                <div class="form-group">
                    <label for="eventDescription"><strong>Beschreibung</strong></label>
                    <p class="card-text" id="eventDescription" name="description">{{ $event->description }}</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eventCost"><strong>Preis</strong></label>
                            <p class="card-text" id="eventCost" name="cost">{{ $event->cost }}</p>
                        </div>
                        <div class="form-group">
                            <label for="eventFrom"><strong>Typ</strong></label>
                            @if($event->map->typ == 1)
                                <p class="card-text" id="eventFrom" name="from">Outdoor</p>
                            @else
                                <p class="card-text" id="eventFrom" name="from">Indoor</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="eventFrom"><strong>Von</strong></label>
                            <p class="card-text" id="eventFrom" name="from">{{ $event->from }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eventMeeting"><strong>Anz. Plätze</strong></label>
                            <p class="card-text" id="eventMeeting" name="meeting">{{ $event->max_player }}</p>
                        </div>
                        <div class="form-group">
                            <label for="eventType"><strong>Art</strong></label>
                            @if($event->type == 1)
                                <p class="card-text" id="eventType" name="type">Spiel</p>
                            @else
                                <p class="card-text" id="eventType" name="type">Training</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="eventTo"><strong>Bis</strong></label>
                            <p class="card-text" id="eventTo" name="to">{{ $event->to }}</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card w-75">
        <div class="card-body">
          <h5 class="card-title pb-3">Map</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="eventCost"><strong>Name</strong></label>
                        <p class="card-text" id="eventCost" name="cost">{{ $event->map->name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="eventCost"><strong>Beschreibung</strong></label>
                        <p class="card-text" id="eventCost" name="cost">{{ $event->map->description }}</p>
                    </div>
            
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="eventMeeting"><strong>Adresse</strong></label>
                        <p class="card-text" id="eventMeeting" name="meeting">{{ $event->map->street . " " . $event->map->nr}}</p>
                        <p class="card-text" id="eventMeeting" name="meeting">{{ $event->map->location->zip . ", " . $event->map->location->city}}</p>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary">Anmelden</a>
            </div>
        </div>
    </div>
    
</div>
@endsection