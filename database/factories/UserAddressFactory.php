<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\UserAddress;
use Faker\Generator as Faker;

$factory->define(UserAddress::class, function (Faker $faker) {
    $addresses = [
        ["北京市", "市辖区", "东城区"],
        ["河北省", "石家庄市", "长安区"],
        ["江苏省", "南京市", "浦口区"],
        ["江苏省", "苏州市", "相城区"],
        ["广东省", "深圳市", "福田区"],
        ["广东省", "广州市", "海珠区"],
    ];
    $street = ["三元里街","松洲街","景泰街","黄石街","同德街","棠景街","新市街","同和街","京溪街","永平街","均禾街","嘉禾街","石井街","金沙街"];

    // randomElement 方法是在数组中随机抽一个出来
    $address = $faker->randomElement($addresses);
    return [
        'province' => $address[0],
        'city'     => $address[1],
        'district' => $address[2],
        'address'  => sprintf($faker->randomElement($street).'道第%d号', $faker->randomNumber(3)),// randomNumber 随机拿一位数
        'zip'      => $faker->postcode,
        'contact_name' => $faker->name,
        'contact_phone' => $faker->phoneNumber,
    ];
});
