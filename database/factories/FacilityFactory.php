<?php

$factory->define(\App\Models\VisitTransfer\Facility::class, function ($faker) {
    return [
        'name' => $faker->name,
        'training_team' => 'atc',
        'open' => true,
        'description' => $faker->paragraph,
    ];
});

$factory->state(\App\Models\VisitTransfer\Facility::class, 'atc_visit', function ($faker) use ($factory) {
    $facility = $factory->raw(\App\Models\VisitTransfer\Facility::class);

    return array_merge($facility, [
        'can_visit' => true,
        'training_team' => 'atc',
    ]);
});

$factory->state(\App\Models\VisitTransfer\Facility::class, 'pilot_visit', function ($faker) use ($factory) {
    $facility = $factory->raw(\App\Models\VisitTransfer\Facility::class);

    return array_merge($facility, [
        'can_visit' => true,
        'training_team' => 'pilot',
    ]);
});

$factory->state(\App\Models\VisitTransfer\Facility::class, 'atc_transfer', function ($faker) use ($factory) {
    $facility = $factory->raw(\App\Models\VisitTransfer\Facility::class);

    return array_merge($facility, [
        'can_transfer' => true,
        'training_team' => 'atc',
        'training_spaces' => 1,
        'training_required' => true,
    ]);
});
