<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Voter;
use Faker\Generator as Faker;

$factory->define(Voter::class, function (Faker $faker) {
    return [
        'num_identification' => $faker->bankAccountNumber,
        'name' => $faker->name,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'enabled' => $faker->boolean,
    ];
});
