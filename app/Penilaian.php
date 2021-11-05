<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = ['bobot_pg', 'bobot_essay'];

    public function jadwal() 
    {
        return $this->belongsTo('App\Jadwal');
    }

    public function murid() 
    {
        return $this->belongsTo('App\Murid');
    }
}
