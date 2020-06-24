<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Ticket;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    $tickets= Ticket::pluck('id');
    $users= User::pluck('id');
    return [
        'comment' => $faker->sentence,
        'ticket_id' => $tickets[rand(0, count($tickets) - 1)],
        'user_id' => $users[rand(0, count($users) - 1)],
    ];
});
