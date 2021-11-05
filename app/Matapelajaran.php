<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Matapelajaran extends Model
{
    use LogsTrait;

    protected $table = 'matapelajaran';
    protected $guarded = [];

    protected static $propertyLogsToShow = 'nama';

    
    public function jurusan() 
    {
        return $this->belongsToMany('App\Jurusan');
    }

    public function jadwal() 
    {
        return $this->hasMany('App\Jadwal');
    }

    public function kelas() 
    {
        return $this->hasMany('App\Kelas');
    }

    public function guru() 
    {
        return $this->belongsToMany('App\Guru');
    }
    
}
