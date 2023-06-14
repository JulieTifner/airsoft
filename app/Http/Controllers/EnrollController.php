<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Map;


class EnrollController extends Controller
{
   
    public function index($eventId)
    {
        $event = Event::find($eventId);
        $maps = Map::all();
    
        if (!$event) {
            return abort(404);
        }
    
        return view('enroll')->with([
            'event' => $event,
            'maps' => $maps,
        ]);
    }


    public function create(Event $event, Request $request)
    {
        $user = $request->user();

        if ($user->events->contains($event->id)) {
            return redirect('/events')->with('message', 'Du bist bereits angemeldet');

        } else {
            
            $user->events()->attach($event->id);
            return redirect('/events')->with('message', 'Anmeldung erfolgreich');

        }
    }


    public function show(){
        
    }
}
