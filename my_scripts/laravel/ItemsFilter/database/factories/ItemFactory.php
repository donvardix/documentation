<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->safeEmail,
        'game' => $faker->randomElement($array = ['Dota 2', 'CS:GO', 'PUBG']),
        'type' => $faker->randomElement($array = ['Ноги', 'Руки', 'Оружие']),
        'rarity' => $faker->randomElement($array = ['Common', 'Uncommon', 'Rare', 'Mythical', 'Legendary', 'Immortal']),
        'hero' => $faker->randomElement($array = ['Bloodseeker', 'Slark', 'Ursa', 'Riki', 'Tidehunter', 'Kunkka']),
        'tradeable' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+7 days'),
    ];
});
