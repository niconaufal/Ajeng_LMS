<?php

use App\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $jurusan1 = new Jurusan();
        $jurusan1->kode_jurusan = 'TKJ';
        $jurusan1->nama = 'Teknik Komputer Dan Jaringan';
        $jurusan1->save();
        $jurusan1->matapelajaran()->attach([1,3]);
    

        $jurusan2 = new Jurusan();
        $jurusan2->kode_jurusan = 'TABOG';
        $jurusan2->nama = 'Tata Boga';
        $jurusan2->save();
        $jurusan2->matapelajaran()->attach([1,2]);
        

        $jurusan3 = new Jurusan();
        $jurusan3->kode_jurusan = 'IPS';
        $jurusan3->nama = 'IPS';
        $jurusan3->save();
        $jurusan3->matapelajaran()->attach([1,2]);
        
    }
}
