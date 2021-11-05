<?php

namespace App\Http\Middleware;

use Closure;
use App\Murid;
use App\Jadwal;
use App\Permission;
use Illuminate\Http\Request;

class EditNilai
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth('admin')->user();

        if($user->hasPermissionTo(Permission::whereSlug('lihat-semua-entitas')) 
        || $user->hasRole('admin')) {
           return $next($request);

        }

        $murid_id = $request->route('idMurid');

        if($murid_id !== null) {

            $murid = Murid::findOrFail($murid_id);

            $jadwal = Jadwal::where('guru_id', $user->guru_id)->where('kelas_id', $murid->kelas_id)->get();

            if(!$jadwal->count()) return abort(403);

            return $next($request);
        }

        return abort(403);
    }
}
