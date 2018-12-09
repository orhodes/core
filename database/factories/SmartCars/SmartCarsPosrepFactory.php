<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Smartcars\Posrep::class, function (Faker $faker) {
    return [
        'bid_id' => factory(\App\Models\Smartcars\Bid::class)->create(),
        'aircraft_id' => factory(\App\Models\Smartcars\Aircraft::class)->create(),
        'route' => 'DCT',
        'altitude' => 1000,
        'heading_mag' => 180,
        'heading_true' => 100,
        'latitude' => 49.20384551,
        'longitude' => -2.19740940,
        'groundspeed' => 100,
        'distance_remaining' => 50,
        'phase' => 0,
        'time_departure' => NULL,
        'time_remaining' => NULL,
        'time_arrival' => NULL,
        'network' => 'VATSIM'
    ];
});
