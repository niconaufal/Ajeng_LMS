<?php

namespace App;

use App\Logs\LogsTrait;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use LogsTrait; 

    protected static $propertyLogsToShow = 'id';
    protected static $recordEvents = ['updated', 'deleted'];

    protected $table = 'soal';
    protected $guarded = [];

    public function paket() 
    {
        return $this->belongsTo('App\Paket');
    }

    public function banksoal() 
    {
        return $this->belongsTo('App\BankSoal', 'bank_soal_id');
    }

    public function konten() 
    {
        return $this->hasMany('App\Konten');
    }

    public function scopeExcludeJawaban($query) 
    {
        return $query->select('id', 'paket_id', 'bank_soal_id', 'isi', 'pilA', 'pilB', 'pilC', 'pilD', 'pilE', 'jenis');
    }
}
