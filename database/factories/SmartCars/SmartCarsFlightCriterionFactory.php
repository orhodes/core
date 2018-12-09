<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Smartcars\FlightCriterion::class, function (Faker $faker) {
    return [
        'flight_id' => factory(\App\Models\Smartcars\Flight::class)->create()->id,
        'order' => $faker->numberBetween(1, 20),
        'p1_latitude' => 50.163124,
        'p1_longitude' => -3.240711,
        'p2_latitude' => 50.186540,
        'p2_longitude' => -1.088397,
        'p3_latitude' => 48.826128,
        'p3_longitude' => -1.112018,
        'p4_latitude' => 48.831968,
        'p4_longitude' => -3.196451,
        'min_altitude' => null,
        'max_altitude' => 10000,
        'min_groundspeed' => null,
        'max_groundspeed' => 250,
    ];
});
