<?php

namespace App;

use App\Logs\LogsTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use LogsTrait;

    protected $table = 'pengumuman';

    protected static $propertyLogsToShow = 'judul';

    public function getCreatedAtAttribute($value) 
    {
        return Carbon::parse($value)->format('d-m-Y h:i');
    }
}
