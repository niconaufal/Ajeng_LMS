<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use LogsTrait;

    protected $table = 'nilai';
    protected $fillable = ['jadwal_id', 'murid_id', 'nilai', 'status'];

    protected static $recordEvents = ['updated'];
    protected static $propertyLogsToShow = 'id';

    public function murid() 
    {
        return $this->belongsTo('App\Murid');
    }

    public function jadwal() 
    {
        return $this->belongsTo('App\Jadwal');
    }
}
