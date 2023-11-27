<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transacao;
use App\Models\Conta;
use Faker\Generator as Faker;

$factory->define(Transacao::class, function (Faker $faker) {
    return [
        'valor' => 200,
        'conta_id' => factory(Conta::class)->create()->id,
        'taxa' => 0,
        'forma_pagamento' => 'D'
    ];
});
