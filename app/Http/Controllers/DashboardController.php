<?php

namespace App\Http\Controllers;

use App\Logs;
use App\Kelas;
use App\Pengumuman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() 
    {
        $pengumuman = Pengumuman::where('jenis', 'guru')->orWhere('jenis', 'keduanya')
            ->orderBy('created_at', 'asc')->take(5)->select('id', 'judul', 'konten')->get();

        $logs = Logs::orderBy('created_at', 'desc')->take(5)->get();

        $kelas = Kelas::inRandomOrder()->withCount('murid')->take(5)->get()->toJson();

        return view('pages.dashboard', compact('pengumuman', 'logs', 'kelas'));
    }
}
