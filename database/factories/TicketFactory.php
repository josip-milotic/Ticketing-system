<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\Ticket;
use App\User;
use Faker\Generator as Faker;
use App\State;

$factory->define(Ticket::class, function (Faker $faker) {

    $states= State::pluck('id');
    $users= User::pluck('id');
    $clients= Client::pluck('id');
    //$states= DB::table('states')->pluck('id');
    return [
        'title' => $faker->title,
        'body' => $faker->paragraph,
        'user_id' => $users[rand(0, count($users) - 1)],
        'state_id' => $states[rand(0, count($states) - 1)],
        'client_id' => $clients[rand(0, count($clients) - 1)],
    ];
});
