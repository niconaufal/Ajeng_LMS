<?php

use App\Paket;
use Illuminate\Database\Seeder;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paket::create([
            'kode_soal' => 'A',
        ]);

        Paket::create([
            'kode_soal' => 'B'
        ]);
    }
}
