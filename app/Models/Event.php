<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'cost', 'start', 'end', 'from', 'to', 'max_player'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user');
    }

    public function map(){

        return $this->belongsTo(Map::class, 'map_id');
    }
}
