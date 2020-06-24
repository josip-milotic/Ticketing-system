<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    $roles = [
        'admin',
        'user',
    ];
    return [
        'role' => $roles[rand(0, count($roles) - 1)],
    ];
});
