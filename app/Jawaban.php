<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $fillable = ['jadwal_id', 'paket_id', 'murid_id', 'soal_id', 'penilaian_id', 'jawaban', 'ragu', 'status'];

    public function jadwal() 
    {
        return $this->belongsTo('App\Jadwal');
    }

    public function murid() 
    {
        return $this->belongsTo('App\Murid');
    }

    public function soal() 
    {
        return $this->belongsTo('App\Soal');
    }

    public function getCreatedAtAttribute($value) 
    {
        return Carbon::parse($value)->format('d-m-Y H:i');
    }

    public function scopeSearch($query, $murid, $jadwal, $soal) 
    {
        return $query->where('murid_id', $murid)->where('jadwal_id', $jadwal)->where('soal_id', $soal);
    }
}
