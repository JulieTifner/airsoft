@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>{{ $event->title }}</h1>
        </div>
        <div class="card-body">
            <form id="eventForm">
               
                <div class="form-group">
                    <label for="eventDescription">Beschreibung</label>
                    <p class="" id="eventDescription" name="description"></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eventCost">Preis</label>
                            <p class="" id="eventCost" name="cost"></p>
                        </div>
                        <div class="form-group">
                            <label for="eventDeadline">Ort</label>
                            <p class="" id="eventDeadline" name="deadline"></p>
                        </div>
                        <div class="form-group">
                            <label for="eventFrom">Von</label>
                            <p class="" id="eventFrom" name="from"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eventMeeting">Anz. Plätze</label>
                            <p class="" id="eventMeeting" name="meeting"></p>
                        </div>
                    
                        <div class="form-group">
                            <label for="eventType">Art</label>
                            <p class="" id="eventType" name="type"></p>
                        </div>
                        <div class="form-group">
                            <label for="eventTo">Bis</label>
                            <p class="" id="eventTo" name="to"></p>
                        </div>
                    </div>
                </div>
            </form>
            <a href="#" class="btn btn-primary">Ok</a>
        </div>
    </div>
</div>
@endsection