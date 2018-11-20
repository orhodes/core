<?php

use App\Models\Cts\Member;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Models\Cts\Session::class, function (Faker $faker) {
    return [
        'position' => $faker->randomElement(['EGLL', 'EGKK', 'EGCC', 'EGBB']).'_'.$faker->randomElement(['N', 'S', 'F', '']).'_'.$faker->randomElement(['TWR', 'APP', 'CTR', 'GND']),
    ];
});
