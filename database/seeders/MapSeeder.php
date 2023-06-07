<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Map;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1 = Outdoor
        //0 = Indoor
        $maps = [
            [
                'name' => 'Shoothouse',
                'description' => 'Eine Wundervolle map im freien bei der wir uns super abschiessen können',
                'type' => 1,
                'street' => 'Hintergumselstrasse',
                'nr' => '34',
                'location_id' => 1
               
            ],
            [
                'name' => 'Rust',
                'description' => 'Grosse Map mit viel Versteckmöglichkeit',
                'type' => 0,
                'street' => 'Anderhanselstrasse',
                'nr' => '47',
                'location_id' => 2
               
              
            ],
          
        ];

        foreach ($maps as $map) {
            Map::create($map);
        }
    }
}
