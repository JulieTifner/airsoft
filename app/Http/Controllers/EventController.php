<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Map;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $maps = Map::all();

        if($request->ajax()) {
            
            $data = Event::whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get(['id', 'title', 'start', 'end']);
            
            return response()->json($data);
        }
        return view('events')->with([
            'maps' => $maps, 
        ]);
        
    }
 


    public function show(Request $request)
    {
        $id = $request->input('eventId');
        $event = Event::with('map')->find($id);
        
        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }
        
        return response()->json($event);
    }



public function update(Request $request)
    {
        $eventId = $request->input('eventId');

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cost' => 'required|numeric',
        ]);

        $event = Event::find($eventId);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $event->title = $validatedData['title'];
        $event->description = $validatedData['description'];
        $event->cost = $validatedData['cost'];
    
        $event->save();

        return response()->json($event);
    }


    public function enroll($eventId)
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

    public function participate(Event $event, Request $request)
    {
        $user = $request->user();

        if ($user->events->contains($event->id)) {
            return redirect('/events')->with('message', 'Du bist bereits angemeldet');

        } else {
            
            $user->events()->attach($event->id);
            return redirect('/events')->with('message', 'Anmeldung erfolgreich');

        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {

        switch ($request->type) {
            case 'add':
                $gameType = ($request->gameType == 1) ? true : false;
                $event = Event::create([
                  'title' => $request->title,
                  'description' => $request->description,
                  'cost' => $request->cost,
                  'start' => $request->start,
                  'end' => $request->end,
                  'from' => $request->from,
                  'to' => $request->to,
                  'max_player' => $request->max_player,
                  'type' => $gameType,
                  'map_id' => $request->map_id

                ]);
                
                
                return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'cost' => $request->cost,
                'start' => $request->start,
                'end' => $request->end,
                'from' => $request->from,
                'to' => $request->to,
                'max_player' => $request->max_player,
                'type' => $request->type,

              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}
