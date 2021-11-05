<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use LogsTrait;
    
    protected $table = 'jurusan';
    protected $guarded = [];

    protected static $propertyLogsToShow = 'nama';

    public function matapelajaran() 
    {
        return $this->belongsToMany('App\Matapelajaran');
    }

    public function kelas()
    {
        return $this->hasMany('App\Kelas');
    }

    public function banksoal() 
    {
        return $this->hasMany('App\BankSoal');
    }
}
