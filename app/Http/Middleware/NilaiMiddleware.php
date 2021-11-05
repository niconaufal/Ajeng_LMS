<?php

namespace App\Http\Middleware;

use Closure;
use App\Murid;
use App\Jadwal;
use App\Permission;

class NilaiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth('admin')->user();

        if($user->hasPermissionTo(Permission::whereSlug('lihat-semua-entitas')) 
        || $user->hasRole('admin')) {
           return $next($request);

        }

        if($request->route('nilai') !== null) {
        
            $murid = Murid::findOrFail($request->route('nilai'));

            $jadwal = Jadwal::where('guru_id', $user->guru_id)->where('kelas_id', $murid->kelas_id)->get();

            if(!$jadwal->count()) return abort(403);

            return $next($request);

        }  

        
        return abort(403);

    }
}
