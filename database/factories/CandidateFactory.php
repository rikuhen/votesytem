<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Candidate;
use Faker\Generator as Faker;

$factory->define(Candidate::class, function (Faker $faker) {
    return [
       'name' => $faker->name,
       'description' => $faker->text,
       'enabled' => 1,
       'type' => 'regular',
    ];
});
