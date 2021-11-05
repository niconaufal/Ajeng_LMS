<?php

namespace App\Http\Controllers;

use App\BankSoal;
use App\Paket;
use App\Jadwal;
use App\Imports\SoalImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class UploadSoalController extends Controller
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

    public function uploadView(Request $request) 
    {
        if(!$request->has('banksoal')) return redirect()->back()->withErrors('Pilih bank soal terlebih dahulu');

        $banksoal = BankSoal::find($request->banksoal);

        $paket = Paket::pluck('kode_soal', 'id')->prepend('Pilih kode soal', '');

        return view('pages.soal.upload', compact('banksoal', 'paket'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'data' => 'required|mimes:xlsx,xls,csv',
            'bank_soal_id' => 'required',
            'paket_id' => 'required|numeric'
        ]);

        Excel::import(new SoalImport($request->paket_id, $request->bank_soal_id), $request->file('data'));

        return redirect()->route('banksoal.index')->with('success', 'Berhasil mengupload soal');
    }
}
