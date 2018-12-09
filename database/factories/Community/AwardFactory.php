<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Community\Award::class, function (Faker $faker) {
    return [
        'awardable_type' => 'App\Models\Smartcars\Flight',
        'awardable_id' => factory(\App\Models\Smartcars\Flight::class)->create()->id,
        'forum_id' => $faker->numberBetween(1,50),
    ];
});
