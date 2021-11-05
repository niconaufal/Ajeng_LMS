<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Murid;
use Illuminate\Http\Request;

class KelasMuridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');    
    }

    public function index()
    {
        $murid = Murid::select(['id', 'nama', 'jenis_kelamin'])->whereNull('kelas_id')->get();
        $kelas = Kelas::pluck('nama_kelas', 'id')->prepend('Pilih Kelas', '');

        return view('pages.kelasmurid.index', compact('murid', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kelas_id' => 'required',
            'murid_id' => 'required'
        ]);
        
        $murid = $request->input('murid_id', null);

        foreach($murid as $item) 
        {
            $muridDipilih = Murid::findOrFail($item);

            $muridDipilih->kelas_id = $request->kelas_id;
            $muridDipilih->save();
        }

        return redirect()->route('kelasmurid.index')->with('success', 'Berhasil menambahkan murid');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
