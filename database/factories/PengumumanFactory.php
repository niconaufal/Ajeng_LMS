<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pengumuman;
use Faker\Generator as Faker;

$factory->define(Pengumuman::class, function (Faker $faker) {
    return [
        'judul' => $faker->sentence('1'),
        'konten' => $faker->paragraph(),
        'jenis' => 'keduanya'
    ];
});
