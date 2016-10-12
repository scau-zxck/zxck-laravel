<?php

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'type' => $faker->numberBetween(1, 2),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Info::class, function(Faker\Generator $faker){
	return [
		'key' => str_random(10),
		'value' => str_random(10),
	];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'serial' => $faker->unique()->word,
        'name' => $faker->word,
        'value' => $faker->word,
    ];
});
