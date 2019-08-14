<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Hotel;
use App\Models\Room;
use Faker\Generator as Faker;

$factory->define(Hotel::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->text($maxNbChars = 200) ,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'country' => $faker->country,
        'rating' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 10),
        'image' => $faker->url,
        'url_hotel' => $faker->url,
        'created_at' => now(),
        'updated_at' => now()
    ];
});

$factory->defineAs(Room::class, 'rooms', function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'image' => $faker->url,
        'price' => 'UAH ' . $faker->numberBetween($min = 250, $max = 1500),
        'occupancy' => 'Вместимость: 1 - ' . $faker->numberBetween($min = 1, $max = 8) . ' гостя'
    ];
});
