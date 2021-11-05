<?php

namespace App;

use Carbon\Carbon;
use App\Logs\LogsTrait;
use App\Classes\GenerateCredential;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use LogsTrait;

    protected static $propertyLogsToShow = 'nama';

    protected $table = 'murid';
    protected $fillable = ['nama', 'nisn', 'nis', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'telp'];

    public static function boot() 
    {
        parent::boot();

        self::created(function($model) {
            $credentialGenerator = new GenerateCredential();

            $credentialGenerator->generateUser($model);
        });
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function setTanggalLahirAttribute($value) 
    {
        $this->attributes['tanggal_lahir'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function kelas() 
    {
        return $this->belongsTo('App\Kelas');
    }

    public function pelaksanaan() 
    {
        return $this->hasMany('App\Pelaksanaan');
    }

    public function jawaban() 
    {
        return $this->hasMany('App\Jawaban');
    }
    
    public function nilai() 
    {
        return $this->hasMany('App\Nilai');
    }
}
