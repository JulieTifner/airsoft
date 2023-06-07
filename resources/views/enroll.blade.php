@extends('layouts.app')

@section('content')

<div class="container mt-5" style=" width: 600px;">
    <div class="card">
        <div class="card-header">
            <h1>{{ $event->title }}</h1>
        </div>
        <div class="card-body">
            <form id="eventForm">
                <div class="form-group">
                    <label for="eventDescription"><strong>Beschreibung</strong></label>
                    <p class="" id="eventDescription" name="description">{{ $event->description }}</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eventCost"><strong>Preis</strong></label>
                            <p class="" id="eventCost" name="cost">{{ $event->cost }}</p>
                        </div>
                        <div class="form-group">
                            <label for="eventDeadline"><strong>Ort</strong></label>
                            <p class="" id="eventDeadline" name="deadline"></p>
                        </div>
                        <div class="form-group">
                            <label for="eventFrom"><strong>Von</strong></label>
                            <p class="" id="eventFrom" name="from">{{ $event->from }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eventMeeting"><strong>Anz. Plätze</strong></label>
                            <p class="" id="eventMeeting" name="meeting">{{ $event->max_player }}</p>
                        </div>
                        <div class="form-group">
                            <label for="eventType"><strong>Art</strong></label>
                            <p class="" id="eventType" name="type"></p>
                        </div>
                        <div class="form-group">
                            <label for="eventTo"><strong>Bis</strong></label>
                            <p class="" id="eventTo" name="to">{{ $event->to }}</p>
                        </div>
                    </div>
                </div>
            </form>
            <a href="#" class="btn btn-primary">Anmelden</a>
        </div>
    </div>
    
</div>
@endsection