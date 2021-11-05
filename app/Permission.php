<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles() 
    {
        return $this->belongsToMany('App\Role');
    }

    public function admin() 
    {
        return $this->belongsToMany('App\Admin');
    }

    public function scopeWhereSlug($query, $permission)
    {
        return $query->where('slug', $permission)->first();
    } 

}   
