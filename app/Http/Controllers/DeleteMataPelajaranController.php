<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;

class DeleteMataPelajaranController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');    
    }

    public function __invoke(Jurusan $jurusan, Request $request)
    {
        $jurusan->matapelajaran()->detach($request->matapelajaran_id);

        return redirect()->back()->with('success', 'Berhasil menghapus');
    }
}
