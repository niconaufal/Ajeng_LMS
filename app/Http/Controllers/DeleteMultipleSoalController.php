<?php

namespace App\Http\Controllers;

use App\Soal;
use HandleFile;
use Illuminate\Http\Request;

class DeleteMultipleSoalController extends Controller
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

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'deleteCheck' => 'required'
        ]);

        $items = $request->input('deleteCheck');

        foreach($items as $item) {
            $soal = Soal::find($item);

            if(count($soal->konten)) {
                foreach($soal->konten as $konten) {
                    $deleteContent = $konten->type === 'image' ? HandleFile::delete($konten->isi, config('enums.path.image')) :
                        HandleFile::delete($konten->isi, config('enums.path.audio'));

                    if(!$deleteContent) continue;

                    $konten->delete();

                }            
            }

            $soal->delete();
        }

        return response('Berhasil menghapus beberapa soal');
    }
}
