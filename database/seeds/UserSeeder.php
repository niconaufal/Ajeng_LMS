<?php

use App\Murid;
Use App\Orangtua;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create murid
        Murid::create([
            'nama' => 'Novitalia',
            'nisn' => '99171011402148',
            'nis' => '171011402148',
            'jenis_kelamin' => 'P',
            'tempat_lahir' => 'Ponorogo',
            'tanggal_lahir' => Carbon::now(),
            'telp' => '0212212201',
        ]); 

        //Create Murid
        Murid::create([
            'nama' => 'Mohammad Arfan',
            'nisn' => '99171011402147',
            'nis' => '171011402147',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Cirebon',
            'tanggal_lahir' => '27-06-1999',
            'telp' => '0212212201',
        ]); 


        //Create Murid
        Murid::create([
            'nama' => 'Dicky Syahbani',
            'nisn' => '99171011402146',
            'nis' => '171011402146',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => Carbon::now(),
            'telp' => '0212212201',
        ]); 


        //Create Murid
       Murid::create([
            'nama' => 'Putra Kamulyan',
            'nisn' => '99171011402145',
            'nis' => '171011402145',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => Carbon::now(),
            'telp' => '082321158479',
        ]);

    }
}
