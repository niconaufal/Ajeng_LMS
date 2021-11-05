<?php

use App\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = new Level();
        $level->nama = 'Kelas 1';
        $level->skala = 1;

        $level->save();
    }
}
