<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Pengumuman;
use App\Http\Controllers\Controller;
use App\Http\Resources\PengumumanResource;


class RestPengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);

        return PengumumanResource::collection(Pengumuman::where('jenis', 'murid')
            ->orWhere('jenis', 'keduanya')
            ->simplePaginate($limit))->additional([
                'status' => 'success',
                'code' => 206
            ]
        );
    }

    public function show(Pengumuman $pengumuman)
    {
        return (new PengumumanResource($pengumuman))->additional(['status' => 'success']);
    }

}
