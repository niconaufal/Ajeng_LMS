<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Murid;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Murid::class, function (Faker $faker) {

    $gender = $faker->randomElement(['L', 'P']);

    return [
        'nama' => $faker->name($gender),
        'nisn' => $faker->randomNumber(5),
        'nis' => $faker->randomNumber(5),
        'jenis_kelamin' => $gender,
        'tempat_lahir' => $faker->city,
        'tanggal_lahir' => Carbon::now(),
        'telp' => $faker->phoneNumber
    ];
});
