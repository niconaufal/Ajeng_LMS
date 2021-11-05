<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use LogsTrait;
    
    protected $table = 'ruangan';
    protected $fillable = ['nama'];

    protected static $propertyLogsToShow = 'nama';

    public function pelaksanaan() 
    {
        return $this->hasMany('App\Pelaksanaan');
    }
}
