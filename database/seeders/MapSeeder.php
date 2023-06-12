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
                'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                'type' => 1,
                'street' => 'Hintergumselstrasse',
                'nr' => '34',
                'location_id' => 1
               
            ],
            [
                'name' => 'Rust',
                'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
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
