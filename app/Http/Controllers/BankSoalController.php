<?php

namespace App\Http\Controllers;

use App\BankSoal;
use HandleFile;
use App\Jurusan;
use App\Level;
use App\Matapelajaran;
use App\Soal;
use App\Guru;
use App\DataTables\BankSoalDataTable;
use App\Http\Requests\BankSoalRequest;
use Illuminate\Http\Request;

class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(BankSoal::class, 'banksoal');    
    }

    public function index(BankSoalDataTable $dataTable)
    {
        return $dataTable->render('pages.banksoal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $guru = null; 

        if(!auth('admin')->user()->hasRole('admin'))
        {
            $guru = Guru::findOrFail(auth('admin')->user()->guru_id);
        } else {
            $guru = Guru::whereNotIn('nama', ['admin'])->pluck('nama', 'id')->prepend('Pilih Guru', '');
        }
      
        return view('pages.banksoal.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankSoalRequest $request)
    {
        $banksoal = new BankSoal($request->except('_token'));

        $banksoal->save();

        return redirect()->route('banksoal.index')->with('success', 'Berhasil menyimpan bank soal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BankSoal $banksoal)
    {
        $paket = $request->input('paket');

        $soal = $paket === null ? Soal::where('bank_soal_id', $banksoal->id)->orderBy('nomor_soal')->get() :
            Soal::where('bank_soal_id', $banksoal->id)->where('paket_id', $paket)->orderBy('nomor_soal')->get();

        return view('pages.banksoal.details', compact('soal', 'banksoal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BankSoal $banksoal)
    {
        
        if(!auth('admin')->user()->hasRole('admin')) {
            $guru = Guru::findOrFail(auth('admin')->user()->guru_id);
        } else {
            $guru = Guru::whereNotIn('nama', ['admin'])->pluck('nama', 'id')->prepend('Pilih Guru', '');

        }
        return view('pages.banksoal.edit', compact('guru', 'banksoal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BankSoalRequest $request, BankSoal $banksoal)
    {
        $banksoal->update([
            'opsi_pg' => $request->opsi_pg,
            'matapelajaran_id' => $request->matapelajaran_id,
            'jurusan_id' => $request->jurusan_id,
            'guru_id' => $request->guru_id,
            'level_id' => $request->level_id,
            'status' => $request->status
        ]);

        return redirect()->route('banksoal.index')->with('success', 'Berhasil mengupdate bank soal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankSoal $banksoal)
    {
        foreach($banksoal->soal as $soal) 
        {
            if($soal->konten->count()) {
                foreach($soal->konten as $konten) {
                    $deleteContent = $konten->type === 'image' ? HandleFile::delete($konten->isi, config('enums.path.image')) :
                        HandleFile::delete($konten->isi, config('enums.path.audio'));
    
                    if(!$deleteContent) continue;
    
                    $konten->delete();
    
                }            
            }
    
            $soal->delete();
        }

        $banksoal->delete();

        return redirect()->route('banksoal.index')->with('success', 'Berhasil menghapus bank soal');

    }
}
