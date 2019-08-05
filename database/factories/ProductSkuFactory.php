<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\ProductSku;
use Faker\Generator as Faker;

$factory->define(ProductSku::class, function (Faker $faker) {
    return [
        'product_code' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomNumber(4),
        'cost' => $faker->randomNumber(4),
        'stock' => $faker->randomNumber(3),
    ];
});
