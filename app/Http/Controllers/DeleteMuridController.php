<?php

namespace App\Http\Controllers;

use App\Murid;
use Illuminate\Http\Request;

class DeleteMuridController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $murid = $request->input('murid_id');

        if($murid == null) 
        {
            return redirect()->route('murid.index')->withErrors('Murid belum dipilih');
        }

        foreach($murid as $item) 
        {
            $murid_entry = Murid::findOrFail($item);

            $murid_entry->kelas_id = null;
            $murid_entry->save();
        }

        return redirect()->back()->with('success', 'Berhasil menghapus murid dari kelas');
    }
}
