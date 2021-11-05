<?php

namespace App\Http\Controllers;

use App\Konten;
use HandleFile;
use App\Soal;
use Illuminate\Http\Request;

class KontenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        //$this->authorizeResource(Konten::class, 'konten');    
    }

    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->has('soal')) return redirect()->back()->withErrors('Soal belum dipilih');

        $soal = Soal::find($request->soal);

        return view('pages.konten.create', compact('soal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $soal = Soal::with('konten')->find($id);

        return view('pages.konten.details', compact('soal'));
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
    public function destroy(Konten $konten)
    {
        // Delete file first
        $deleteFile = HandleFile::delete(config('enums.path.imageSoal'), $konten->isi);

        if(!$deleteFile) return redirect()->route('banksoal.index')->withErrors('Gagal menghapus konten/media');
        
        $konten->delete();

        return redirect()->route('banksoal.index')->with('success', 'Berhasil menghapus konten');
    }
}
