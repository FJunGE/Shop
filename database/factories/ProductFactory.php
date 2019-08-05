<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $image = $faker->randomElement([
        "http://m.360buyimg.com/babel/jfs/t1/1468/11/3377/138213/5b997bf3Eda5b24a4/0ace3ed19582dbe6.jpg!q70.jpg",
        "http://m.360buyimg.com/babel/jfs/t1/27653/36/12572/346766/5c99ef63E81a8de14/5a38e39b2975e837.jpg!q70.jpg",
        "http://m.360buyimg.com/babel/jfs/t1/20934/9/14668/305219/5caac06cEb41f2374/a57323b77d9c53e5.jpg!q70.jpg",
        "http://m.360buyimg.com/babel/jfs/t1/41069/14/5268/224755/5ceb4b2dE509aca2c/c57bbc4a52f3f8ee.jpg!q70.jpg",
        "http://m.360buyimg.com/babel/jfs/t1/35979/14/4669/361147/5cc551aeE17a036eb/6612ea19b14e7dc4.jpg!q70.jpg",
        "http://img13.360buyimg.com/n7/jfs/t8284/363/1326459580/71585/6d3e8013/59b857f2N6ca75622.jpg",
        "http://img13.360buyimg.com/n7/jfs/t1/16446/33/13283/339849/5c9eca5bE06fce1b2/500f99a976998161.jpg",
        "http://img11.360buyimg.com/n7/jfs/t1/83118/1/488/217626/5ceb8ee6Edc08ec3c/d44fcf68cdedc317.jpg",
        "http://img12.360buyimg.com/n7/jfs/t30031/152/1332312785/300863/cdf3a03d/5cdd233eN69626d85.jpg",
        "http://img13.360buyimg.com/n7/jfs/t1/45707/34/648/300546/5ce44d8fE72d72070/62cf191f88e41447.jpg",
    ]);

    return [
        'title' => $faker->word,
        'description' => $faker->sentence,
        'image' => $image,
        'on_sale' => true,
        'rating' => $faker->numberBetween(0,5),
        'sold_count' => 0,
        'review_count' => 0,
        'price' => 0,
    ];
});
