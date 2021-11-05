<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Admin;
use App\Classes\GenerateCredential;
use HandleFile;
use Illuminate\Http\Request;
use App\DataTables\GuruDataTable;
use App\Http\Requests\GuruRequest;
use App\Matapelajaran;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Guru::class, 'guru');
    }

    public function index(GuruDataTable $dataTable)
    {
        return $dataTable->render('pages.guru.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listMatapelajaran = Matapelajaran::select('id', 'nama')->get();

        $guru = Guru::whereNotIn('nama', ['admin'])->select(['id', 'nama', 'jenis_kelamin'])->get();

        return view('pages.guru.create', compact('guru', 'listMatapelajaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuruRequest $request)
    {
        $superadmin = $request->input('superadmin', false);

        $password = $request->input('password', null);

        if($superadmin && Auth::guard('admin')->check() != true) {
            return redirect('guru.index')->withErrors('Terjadi kesalahan saat menyimpan data guru');
        }

        $guru = new Guru();

        $guru->nuptk = $request->nuptk;
        $guru->nama = $request->nama;
        $guru->email = $request->email;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->telp = $request->telp;

        $fotoGuru = $request->file('fotoguru');

        if($request->fotoguru !== null) 
        {
            $resizedImage = HandleFile::resizeAndSaveImage($fotoGuru, config('enums.path.fotoguru'));

            $guru->foto = $resizedImage;

        }

        if($guru->save())
        {
            $adminGenerator = new GenerateCredential();

            $adminGenerator->generateAdmin($guru, $superadmin, $password);

            if($request->has('matapelajaran') && $request->matapelajaran !== null && $request->matapelajaran !== []) {
                foreach($request->matapelajaran as $matapelajaran) {
                    $guru->matapelajaran()->attach($matapelajaran);
                }
            }

        }
        
        return redirect()->route('guru.index')->with('success', 'Berhasil menyimpan guru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        return view('pages.guru.details', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        $listMatapelajaran = Matapelajaran::pluck('nama', 'id')->prepend('Pilih mata pelajaran', '');

        return view('pages.guru.edit', compact('guru', 'listMatapelajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuruRequest $request, Guru $guru)
    {  
        $guru->nama = $request->nama;
        $guru->nuptk = $request->nuptk;
        $guru->email = $request->email;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->telp = $request->telp;

        $fotoGuru = $request->file('fotoguru');

        if($request->fotoguru !== null) 
        {
            // Delete old photo first
            if(HandleFile::hasFile(config('enums.path.fotoguru') . '/' . $guru->foto)) 
            {
                HandleFile::delete($guru->foto, config('enums.path.fotoguru'));
            }

            $resizedImage = HandleFile::resizeAndSaveImage($fotoGuru, config('enums.path.fotoguru'));

            $guru->foto = $resizedImage;

        }

        $guru->save();
        
        $admin = Admin::where('guru_id', $guru->id)->first();
        $admin->nama = $request->nama;

        $admin->save();

        return redirect()->route('guru.index')->with('success', 'Berhasil mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        $admin = $guru->admin;

        if($admin->id === 1) return redirect()->route('admin.index')->withErrors('Tidak dapat menghapus akun default');

        if($admin !== null && $admin->delete()) 
        {
            $fotoGuru = $guru->foto;

            if($guru->delete()) 
            {
                if(HandleFile::hasFile(config('enums.path.fotoguru') . '/' . $fotoGuru)) 
                {
                    HandleFile::delete($fotoGuru, config('enums.path.fotoguru'));
                }
            }


            return redirect()->route('guru.index')->with('success', 'Berhasil menghapus guru');
        }

        return redirect()->back()->withErrors('Gagal menghapus guru');
    }
}
