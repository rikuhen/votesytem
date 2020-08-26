<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Dignity;
use Faker\Generator as Faker;

$factory->define(Dignity::class, function (Faker $faker) {
    $mode = ['list','candidate'];
    $rndMode = array_rand($mode);
    return [
        'name' => $faker->unique()->name,
        'mode_vote' => $mode[$rndMode],
        'state' =>$faker->boolean
    ];
});
