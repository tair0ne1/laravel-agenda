<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Activity;
use Carbon\Carbon;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Activity::class, function (Faker $faker) {
    $now = Carbon::now();
    return [
        'title'       => $faker->sentence(),
        'description' => $faker->paragraphs(),
        'start_date'  => $now->addMinutes(3),
        'deadline'    => $now->addMinutes(30),
        'end_date'    => null,
        'user_id'     => 1,
        'status_id'   => 1
    ];
});
