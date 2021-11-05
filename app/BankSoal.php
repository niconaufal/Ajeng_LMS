<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    use LogsTrait;
    
    protected $table = 'bank_soal';

    protected static $propertyLogsToShow = 'id';

    protected $fillable = ['level_id', 'matapelajaran_id', 'jurusan_id', 'guru_id', 'opsi_pg', 'status'];

    public function jadwal() 
    {
        return $this->hasMany('App\Jadwal');
    }

    public function soal() 
    {
        return $this->hasMany('App\Soal');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function matapelajaran() 
    {
        return $this->belongsTo('App\Matapelajaran');
    }

    public function jurusan() 
    {
        return $this->belongsTo('App\Jurusan');
    }

    public function guru() 
    {
        return $this->belongsTo('App\Guru');
    }

    public function scopeWhereActive($query)
    {
        return $query->where('status', 'Aktif');
    }
}
