<?php

namespace App\Http\Controllers;

use App\DataTables\KelasDataTable;
use App\Http\Requests\KelasRequest;
use App\Jurusan;
use App\Kelas;
use App\Level;
use App\Murid;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $level;
    public $jurusan;
    public $murid;

    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->authorizeResource(Kelas::class, 'kelas');

        $this->level = Level::pluck('nama', 'id')->prepend('Pilih Level', '');
        $this->jurusan = Jurusan::pluck('nama', 'id')->prepend('Pilih Jurusan', '');
        $this->murid = Murid::select(['id', 'nama', 'jenis_kelamin'])->whereNull('kelas_id')->get();
    }

    public function index(KelasDataTable $dataTable)
    {
        return $dataTable->render('pages.kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kelas.create', array('level' => $this->level, 'jurusan' => $this->jurusan, 'murid' => $this->murid));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasRequest $request)
    {
        $murid = $request->input('murid', null);

        $kelas = new Kelas($request->except(['_token', 'murid']));

        $kelas->save();

        if($murid != null) {
            foreach($murid as $item) {
                $muridDipilih = Murid::findOrFail($item);

                $muridDipilih->kelas_id = $kelas->id;
                $muridDipilih->save();
            }
        }

        return redirect()->route('class.index')->with('success', 'Berhasil membuat kelas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::with('murid')->findOrFail($id);

        return view('pages.kelas.details', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
                   
        return view('pages.kelas.edit', array('kelas' => $kelas, 'level' => $this->level, 'jurusan' => $this->jurusan, 'murid' => $this->murid));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KelasRequest $request, Kelas $kelas)
    {
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'level_id' => $request->level_id
        ]);
        
        return redirect()->route('class.index')->with('success', 'Berhasil mengupdate kelas');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('class.index')->with('success', 'Berhasil menghapus kelas');

    }
}
