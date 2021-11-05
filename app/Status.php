<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use LogsTrait;
    
    protected $table = 'status';
    protected $fillable = ['jadwal_id', 'status', 'token', 'sesi_id'];

    protected static $propertyLogsToShow = 'id';

    public function jadwal() 
    {
        return $this->belongsTo('App\Jadwal');
    }

    public function scopeWhereActive($query)
    {
        return $query->where('status', 'Aktif')->orderBy('sesi_id');
    }

    public function scopeWhereNonActive($query)
    {
        return $query->where('status', 'Nonaktif')->orderBy('sesi_id');
    }

    public function sesi() 
    {
        return $this->belongsTo('App\Sesi');
    }
}
