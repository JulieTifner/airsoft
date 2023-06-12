<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'description', 'type', 'street', 'nr', 'location_id'
    ];


    public function event()
    {
        return $this->hasMany(Event::class);
    }


    public function location(){

        return $this->belongsTo(Location::class, 'location_id');
    }
}
