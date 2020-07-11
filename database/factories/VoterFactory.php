<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Voter;
use Faker\Generator as Faker;



$factory->define(Voter::class, function (Faker $faker) {
    return [
        'identification' => $faker->bankAccountNumber,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('password'), // password
        'role' => 'voter',
        'enabled' => $faker->boolean,
    ];
});
