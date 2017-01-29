<?php

use App\PollQuestion;
use App\PollAnswer;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(PollQuestion::class, function (Faker\Generator $faker) {
    return [
        'text' => $faker->text,
    ];
});

$factory->define(PollAnswer::class, function (Faker\Generator $faker) {
    return [
        'text'             => $faker->text,
        'poll_question_id' => function () {
            return factory(PollQuestion::class)->create()->id;
        },
    ];
});
