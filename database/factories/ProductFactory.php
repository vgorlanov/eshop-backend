<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$images = [
    'https://cdn.vuetifyjs.com/images/cards/docks.jpg',
    'https://cdn.vuetifyjs.com/images/cards/store.jpg',
    'https://cdn.vuetifyjs.com/images/cards/cooking.png',
    'https://cdn.vuetifyjs.com/images/cards/mountain.jpg',
    'https://cdn.vuetifyjs.com/images/cards/house.jpg',
    'https://cdn.vuetifyjs.com/images/cards/road.jpg',
    'https://cdn.vuetifyjs.com/images/cards/plane.jpg',
    'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
    'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
];

$factory->define(Product::class, function (Faker $faker) use ($images) {
    return [
        'name'        => $faker->realText(20),
        'description' => $faker->realText(),
        'price'       => $faker->randomNumber(2),
        'images'      => $images[random_int(0, count($images) - 1)],
        'category_id' => random_int(1, 8),
    ];
});

