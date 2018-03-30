<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'stream_token' => str_random(10)
    ];
});

$factory->define(App\Chatmessage::class, function (Faker $faker) {
	return [
		'message' => $faker->text,
		'chat_id' => "2"
	];
});

$factory->define(App\Stream::class, function (Faker $faker, $user) {
    return [
        'game_id' => random_int(1,7),
        'title' => $faker->sentence($nbWords = 6),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];
});

$factory->define(App\Announcement::class, function(Faker $faker) {
    return [
        'user_id' => random_int(2,4),
        'title' => $faker->sentence($nbWords = 6),
        'message' => $faker->realText($maxNbChars = 1000, $indexSize = 2),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
});