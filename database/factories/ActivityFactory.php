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
        'description' => $faker->paragraphs(1, true),
        'start_date'  => $now->addMinutes(3)->format('Y-m-d H:i'),
        'deadline'    => $now->addMinutes(30)->format('Y-m-d H:i'),
        'end_date'    => null,
        'user_id'     => 1,
        'status_id'   => env('DONE_STATUS')
    ];
});
