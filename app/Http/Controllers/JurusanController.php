<?php

namespace App\Http\Controllers;

use App\DataTables\JurusanDataTable;
use App\Http\Requests\JurusanRequest;
use App\Jurusan;
use App\Matapelajaran;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Jurusan::class, 'jurusan');
    }

    public function index(JurusanDataTable $dataTable)
    {        
        return $dataTable->render('pages.jurusan.index');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matapelajaran = Matapelajaran::all();

        return view('pages.jurusan.create', compact('matapelajaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurusanRequest $request)
    {
        $jurusan = new Jurusan($request->except(['matapelajaran', 'matapelajaran_length']));

        $jurusan->save();

        $matapelajaran = $request->input(['matapelajaran'], null);

        if($matapelajaran != null) {
            foreach($matapelajaran as $pelajaran) {
                $jurusan->matapelajaran()->attach($pelajaran);
            }
        }

        return redirect()->route('jurusan.index')->with('success', 'Berhasil menambahkan jurusan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        return view('pages.jurusan.details', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        $matapelajaran = Matapelajaran::all();

        return view('pages.jurusan.edit', compact('jurusan', 'matapelajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JurusanRequest $request, Jurusan $jurusan)
    {
        $jurusan->update([
            'kode_jurusan' => $request->kode_jurusan,
            'nama' => $request->nama
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Berhasil mengupdate jurusan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Berhasil menghapus jurusan');
    }
}
