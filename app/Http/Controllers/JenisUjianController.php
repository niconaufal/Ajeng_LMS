<?php

namespace App\Http\Controllers;

use App\DataTables\JenisUjianDataTable;
use App\Http\Requests\JenisUjianRequest;
use App\JenisUjian;
use Illuminate\Http\Request;

class JenisUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role')->except('index');   
    }

    public function index(JenisUjianDataTable $dataTable)
    {
        return $dataTable->render('pages.jenisujian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.jenisujian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisUjianRequest $request)
    {
        $jenisUjian = new JenisUjian($request->except('_token'));

        $jenisUjian->save();

        return redirect()->route('jenisujian.index')->with('success', 'Berhasil membuat jenis ujian');
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
    public function edit(JenisUjian $jenisujian)
    {
        return view('pages.jenisujian.edit', compact('jenisujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JenisUjianRequest $request, JenisUjian $jenisujian)
    {
        $jenisujian->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('jenisujian.index')->with('success', 'Berhasil mengupdate jenis ujian');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisUjian $jenisujian)
    {
        $jenisujian->delete();

        return redirect()->route('jenisujian.index')->with('success', 'Berhasil menghapus jenis ujian');
    }
}
