<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\Penilaian;
use App\Kelas;
use App\Jawaban;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('penilaian');   
    }

    public function index()
    {

        $kelas = null;

        if(auth('admin')->user()->hasRole('guru')) 
        {
            $kelas = Kelas::whereHas('jadwal', function($query) {
                $query->where('guru_id', auth('admin')->user()->guru_id);

            })->select('id', 'nama_kelas')->get();
        } else {
            $kelas = Kelas::select('id', 'nama_kelas')->get();
        }

        return view('pages.penilaian.index', compact('kelas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $kelas = Kelas::find($id);

        return view('pages.penilaian.details', compact('kelas'));
    }

}
