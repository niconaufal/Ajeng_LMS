<?php 

namespace App\Classes;

use App\Admin;
use App\User;
use Carbon\Carbon;

class GenerateCredential {

    public function generateUser($model) 
    {
        $user = new User();
      
        $user->nama = $model->nama;
        $user->nis = $model->nis;
        $user->murid_id = $model->id;

        $tanggal_lahir = Carbon::parse($model->tanggal_lahir)->format('d-m-Y');
        $password = str_replace('-', '', $tanggal_lahir);

        // $user->password = bcrypt($password);
        $user->password = bcrypt('user123');

        $user->save();

    }
    
    public function generateAdmin($model, $superadmin = false, $customPassword = null) 
    {
        $admin = new Admin();

        $admin->nama = $model->nama;
        $admin->email = $model->email;

        if($customPassword !== null) {
            $admin->password = bcrypt($customPassword);
        } else {
            $fourDigitsNuptk = substr($model->nuptk, 0, 4);
            $tanggalLahir = Carbon::parse($model->tanggal_lahir)->format('Y');

            $admin->password = bcrypt($fourDigitsNuptk . $tanggalLahir);
        }

        $admin->superadmin = $superadmin;
        $admin->guru_id = $model->id;

        $admin->save();
    }
}