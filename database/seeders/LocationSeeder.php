<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;


class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $locations = [
            [
                'city' => 'Uster',
                'zip' => '9823'
               
            ],
            [
                'city' => 'Mönchaltorf',
                'zip' => '8617'
              
            ],
            [
                'city' => 'Rüti',
                'zip' => '2823'
             
            ],
            [
                'city' => 'Esslingen',
                'zip' => '5353'
             
            ],
        ];

        foreach ($locations as $loc) {
            Location::create($loc);
        }

   
    }
}
