<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    // Menampilkan jadwal di halaman utama
    public function welcome()
    {
        $hariIni = Carbon::today()->toDateString();
        $jadwals = Peminjaman::where('tanggal', $hariIni)
            ->orderBy('waktu_mulai', 'desc')
            ->get();
        return view('welcome', compact('hariIni', 'jadwals'));
    }
}
