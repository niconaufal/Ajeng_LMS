<?php

use App\Admin;
use Carbon\Carbon;
use App\Guru;
use App\Role;
use App\Classes\GenerateCredential;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminGenerator = new GenerateCredential();

        // Create superadmin

        $guru = new Guru();

        $guru->nama = 'Admin';
        $guru->nuptk = '99171011402149';
        $guru->email = 'admin@cbtexam.com';
        $guru->jenis_kelamin = 'L';
        $guru->tempat_lahir = 'Jogjakarta';
        $guru->tanggal_lahir = Carbon::now();
        $guru-> telp = '082321156781';

        if($guru->save()) $adminGenerator->generateAdmin($guru, true,'admin123');
        

        // Create guru

        $guru = new Guru();

        $guru->nama = 'Susilawati';
        $guru->nuptk = '99171011402150';
        $guru->email = 'susilawati@cbtexam.com';
        $guru->jenis_kelamin = 'P';
        $guru->tempat_lahir = 'Majalengka';
        $guru->tanggal_lahir = Carbon::now();
        $guru->telp = '082321159901';

        if($guru->save()) $adminGenerator->generateAdmin($guru, false,'admin123');

    }
}
