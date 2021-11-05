<?php

use App\Matapelajaran;
use Illuminate\Database\Seeder;

class MatapelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama' => 'IPA'],
            ['nama' => 'IPS'],
            ['nama' => 'Jaringan'],
        ];

        Matapelajaran::insert($data);
    }
}
