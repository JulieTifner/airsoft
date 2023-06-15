<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Map;
use App\Models\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $maps = Map::all();

        $user = $request->user();
        $eventData = collect();

        if ($user) {
            $eventIds = $user->events()->pluck('event_id');

            $events = Event::whereIn('id', $eventIds)->get();

            $eventData = $events->map(function ($event) {
                $start = Carbon::parse($event->start)->format('d.m.Y');
                return $event->title . ', ' . $start;
            });
        }

        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('events')->with([
            'maps' => $maps,
            'eventData' => $eventData,
        ]);
    }

    public function show(Request $request)
    {
        $id = $request->input('eventId');
        $event = Event::with('map')->find($id);
    
        $eventEnroll = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $userIds = $eventEnroll->users()->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();
    
        $userNames = $users->map(function ($user) {
            return $user->firstname . ' ' . $user->lastname;
        });
    
    
        
    
        return response()->json(['event' => $event, 'userNames' => $userNames]);
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
