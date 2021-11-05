<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use LogsTrait;
    
    protected static $propertyLogsToShow = 'id';

    protected $table = 'konten';

    public function soal() 
    {
        return $this->belongsTo('App\Soal');
    }
}
