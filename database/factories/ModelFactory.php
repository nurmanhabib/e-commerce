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

$factory->define(App\Models\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Models\Supplier::class, function ($faker) {
    return [
        'code' 				=> $faker->name,
        'name' 				=> $faker->name,
        'address_line_1' 	=> $faker->email,
        'address_line_2' 	=> $faker->email,
        'phone_1' 			=> $faker->email,
        'phone_2' 			=> $faker->email,
        'email' 			=> $faker->email,
        'website' 			=> $faker->email,
        'website' 			=> $faker->email,
    ];
});

$factory->define(App\Models\Supplier::class, function ($faker) {
    return [
        'name' 				=> $faker->sentence(3) . ' Shop',
        'address_line_1' 	=> $faker->streetAddress,
        'address_line_2' 	=> null,
        'phone_1' 			=> '085' . $faker->randomElement([1, 2, 3, 5, 6, 7]) . $faker->randomNumber(8),
        'phone_2' 			=> '085' . $faker->randomElement([1, 2, 3, 5, 6, 7]) . $faker->randomNumber(8),
        'email' 			=> $faker->freeEmail,
        'website' 			=> 'http://' . $faker->domainName,
    ];
});

$factory->define(App\Models\Product::class, function ($faker) {
	$name = $faker->name;

    return [
    	'code'				=> substr($name, 0, 3),
        'name' 				=> $name,
        'description' 		=> $faker->streetAddress,
        'price' 			=> $faker->randomElement([10000, 15000, 200300, 500500, 750000, 30000]),
        'stock' 			=> $faker->randomDigitNotNull,
    ];
});
