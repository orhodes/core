<?php

    use Carbon\Carbon;
    use Faker\Generator as Faker;

    $factory->define(\App\Models\NetworkData\Atc::class, function (Faker $faker) {
        $facility = $faker->randomElement([[4, 'TWR'], [3, 'GND'], [2, 'DEL'], [5, 'APP']]);

        return [
            'account_id' => function () {
                return factory(\App\Models\Mship\Account::class)->create()->id;
            },
            'callsign' => $faker->randomElement(['EGLL', 'EGKK', 'EGCC', 'EGBB']).'_'.$faker->randomElement(['N', 'S', 'F', '']).'_'.$facility[1],
            'frequency' => $faker->randomFloat(3, 118, 134),
            'connected_at' => $faker->dateTimeBetween('6 hours ago'),
            'facility_type' => $facility[0],
            'qualification_id' => function () {
                return factory(\App\Models\Mship\Qualification::class)->create()->id;
            },
        ];
    });
    $factory->defineAs(\App\Models\NetworkData\Atc::class, 'offline', function (Faker $faker) {
        $start = $faker->dateTimeBetween('6 hours ago');
        $end = $faker->dateTimeBetween($start);

        return array_merge(
            factory(\App\Models\NetworkData\Atc::class)->raw(),
            [
                'connected_at' => $start,
                'disconnected_at' => $faker->dateTimeBetween($start),
                'minutes_online' => Carbon::instance($start)->diffInMinutes(Carbon::instance($end)),
            ]
        );
    });

$factory->define(\App\Models\NetworkData\Pilot::class, function (Faker $faker) {
    $start = $faker->dateTimeBetween('6 hours ago');
    $end = $faker->dateTimeBetween($start);

    return [
        'account_id' => factory(\App\Models\Mship\Account::class)->create(),
        'callsign' => 'BAW47C',
        'flight_type' => 'I',
        'departure_airport' => 'EGKK',
        'arrival_airport' => 'EGKK',
        'alternative_airport' => 'KJFK',
        'aircraft' => 'H/B77W/L',
        'cruise_altitude' => '37000',
        'cruise_tas' => '450',
        'route' => 'DCT',
        'remarks' => '',
        'connected_at' => $start,
        'disconnected_at' => null,
        'minutes_online' => null,
        'created_at' => Carbon::now(),
    ];

});

