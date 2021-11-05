<?php

namespace App;

use App\Logs\LogsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use LogsTrait;
    
    protected $table = 'guru';
    protected static $propertyLogsToShow = 'nama';  
    protected $fillable = ['nama', 'nuptk', 'email', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'telp'];

    public function admin() 
    {
        return $this->hasOne('App\Admin');
    }

    public function jadwal() 
    {
        return $this->hasMany('App\Jadwal');
    }

    public function setTanggalLahirAttribute($value) 
    {
        $this->attributes['tanggal_lahir'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getTanggalLahirAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function matapelajaran() 
    {
        return $this->belongsToMany('App\Matapelajaran');
    }

}
