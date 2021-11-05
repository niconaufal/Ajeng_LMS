<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use LogsTrait;
    
    protected $table = 'paket';

    protected $fillable = ['kode_soal'];
    
    protected static $propertyLogsToShow = 'nama';

    public function pelaksanaan() 
    {
        return $this->hasMany('App\Pelaksanaan');
    }
}
