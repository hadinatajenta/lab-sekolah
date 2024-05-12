<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $guru = User::where('role_id', 3)->count();
        $jadwal = Peminjaman::take(5)->get();
        $lab = Lab::count();
        $labTersedia = Lab::where('status', 'Tersedia')->take(5)->get();
        $labTdkTersedia = Lab::where('status', 'Tidak Tersedia')->take(5)->get();

        $bulan = $request->input('month', date('m'));
        $tahun = $request->input('year', date('Y'));
        $events = Peminjaman::whereMonth('tanggal', '=', $bulan)
            ->whereYear('tanggal', '=', $tahun)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->tanggal)->format('j'); // mengelompokkan berdasarkan tanggal
            });
        $hariIni = Carbon::today()->toDateString();
        $jadwals = Peminjaman::where('tanggal', $hariIni)
            ->orderBy('waktu_mulai', 'desc')
            ->get();
        return view('dashboard', compact('guru', 'jadwal', 'labTersedia', 'labTdkTersedia', 'bulan', 'tahun', 'events', 'hariIni', 'jadwals', 'lab'));
    }


}
