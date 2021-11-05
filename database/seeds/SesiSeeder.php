<?php

use App\Sesi;
use Illuminate\Database\Seeder;

class SesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sesi = new Sesi();

        $sesi->nama = "Sesi 1";
        $sesi->start = "10:00";
        $sesi->end = "12:30";

        $sesi->save();
    }
}
