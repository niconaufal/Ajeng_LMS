<?php

use App\JenisUjian;
use Illuminate\Database\Seeder;

class JenisUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisUjian::create([
            'nama' => 'tugas'
        ]);

        JenisUjian::create([
            'nama' => 'uts'
        ]);

        JenisUjian::create([
            'nama' => 'uas'
        ]);
    }
}
