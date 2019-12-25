<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vehicle\Vehicle;
use App\Models\Vehicle\VehicleCategory;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'user_id'      => 2,
        'category_id'  => VehicleCategory::all()->random()->id,
        'vin_number'   => $faker->bankAccountNumber,
        'address'      => $faker->address,
        'zipcode'      => $faker->numberBetween(0000, 9999),
        'make'         => $faker->word(),
        'model'        => $faker->word(),
        'year'         => $faker->year(),
        'mileage'      => $faker->numberBetween(0000, 99999999),
        'transmission' => $faker->randomElement(['automatic', 'manual']),
        'drivetrain'   => $faker->word(),
        'color'        => $faker->colorName,
        'trim'         => $faker->word(),
        'engine_type'  => $faker->randomElement(['Single Cylinder', 'Twin Cylinder', 'Three Cylinder', 'Four Cylinder', 'Five Cynlinder']),
        'fuel_type'    => $faker->randomElement(['Petrol', 'Diesel', 'Ethanol', 'Biodiesel', 'Liquified']),
        'price'        => $faker->numberBetween(10000, 1000000),
        'auction_type' => $faker->randomElement(['red', 'blue', 'green', 'yellow']),
        'status'       => $faker->numberBetween(0, 2)
    ];
});
