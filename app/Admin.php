<?php

namespace App;

use App\Logs\LogsTrait;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasPermissionsTrait, LogsTrait;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected static $propertyLogsToShow = 'nama';

    public static function boot() 
    {
        parent::boot();

        self::created(function($model) {
            if($model->superadmin) {
                $adminRole = Role::where('slug', 'admin')->first();

                $model->roles()->attach($adminRole);
            } else {
                $guruRole = Role::where('slug', 'guru')->first();

                $model->roles()->attach($guruRole);
            }
        });
    }

    protected $fillable = [
        'nama', 'nig', 'guru_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function guru() 
    {
        return $this->belongsTo('App\Guru');
    }

    public function scopeGetUsername($query, $value, $propertyName)
    {
        $query->where($propertyName, $value)->select('nama');
    }
}
