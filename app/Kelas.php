<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use LogsTrait;
    
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'level_id', 'jurusan_id'];

    protected static $propertyLogsToShow = 'nama_kelas';

    public function level() 
    {
        return $this->belongsTo('App\Level');
    }

    public function murid() 
    {
        return $this->hasMany('App\Murid');
    }

    public function jurusan() 
    {
        return $this->belongsTo('App\Jurusan');
    }

    public function jadwal() 
    {
        return $this->hasMany('App\Jadwal');
    }
}
