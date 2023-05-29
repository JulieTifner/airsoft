<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Location;

use DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::whereIn('id', [2, 3])->pluck('id');
        $faker = Faker::create();


        $users = [
            [
                'firstname' => 'user',
                'lastname' => 'user',
                'street' => $faker->streetName,
                'nr' => $faker->buildingNumber ,
                'phone' => $faker->phoneNumber,
                'birthday' => now(),
                'email' => 'user@user.ch',
                'password' => '12345678',
                'location_id' => Location::inRandomOrder()->first()->id,
                'role_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'intern',
                'lastname' => 'intern',
                'street' => $faker->streetName,
                'nr' => $faker->buildingNumber ,
                'phone' => $faker->phoneNumber,
                'birthday' => now(),
                'email' => 'intern@intern.ch',
                'password' => '12345678',
                'location_id' => Location::inRandomOrder()->first()->id,
                'role_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'admin',
                'lastname' => 'admin',
                'street' => $faker->streetName,
                'nr' => $faker->buildingNumber ,
                'phone' => $faker->phoneNumber,
                'birthday' => now(),
                'email' => 'admin@admin.ch',
                'password' => '12345678',
                'location_id' => Location::inRandomOrder()->first()->id,
                'role_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        foreach (range(1, 6) as $index) {
            DB::table('users')->insert([
                'firstname' => $faker->firstname,
                'lastname' => $faker->lastname,
                'street' => $faker->streetName,
                'nr' => $faker->buildingNumber,
                'phone' => $faker->phoneNumber,
                'birthday' => now(),
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'location_id' => Location::inRandomOrder()->first()->id,
                'role_id' => $faker->randomElement($roles),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
