<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use LogsTrait;
    
    protected $fillable = ['nama', 'skala'];

    protected static $propertyLogsToShow = 'nama';

    public function kelas() 
    {
        return $this->hasMany('App\Kelas');
    }
}
