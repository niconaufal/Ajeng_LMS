<?php

use App\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas1 = new Kelas();

        $kelas1->nama_kelas = 'X TKJ 1';
        $kelas1->jurusan_id = 1;
        $kelas1->level_id = 1;
        $kelas1->save();

        $kelas2 = new Kelas();

        $kelas2->nama_kelas = 'X TABOG 1';
        $kelas2->jurusan_id = 2;
        $kelas2->level_id = 1;
        $kelas2->save();
    }
}
