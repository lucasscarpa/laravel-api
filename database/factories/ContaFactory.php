<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Conta;
use Faker\Generator as Faker;

$factory->define(Conta::class, function (Faker $faker) {
    return [
        'saldo' => $faker->randomFloat(2, 1, 5000)
    ];
});
