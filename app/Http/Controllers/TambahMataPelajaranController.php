<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;

class TambahMataPelajaranController extends Controller
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
        $matapelajaran = $request->input('matapelajaran', null);

        if($matapelajaran == null) {
            return redirect()->route('jurusan.index')->withErrors('Matapelajaran belum dipilih');
        }

        foreach($matapelajaran as $pelajaran) {
            $jurusan->matapelajaran()->attach($pelajaran);
        }

        return redirect()->route('jurusan.index')->with('success', 'Berhasil menambahkan matapelajaran');
    }
}
