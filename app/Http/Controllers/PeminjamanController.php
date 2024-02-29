<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Lab;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // daftar jadwal lab
    public function pinjaman(Request $request): View
    {
        $peminjaman  = Peminjaman::paginate(10);

        // Update status untuk jadwal peminjaman LAB
        foreach ($peminjaman as $pjm) {
            $now = Carbon::now('Asia/Jakarta'); // Time zone Jakarta
            $waktuMulai = Carbon::createFromFormat('Y-m-d H:i:s', $pjm->tanggal . ' ' . $pjm->waktu_mulai, 'Asia/Jakarta');
            $waktuSelesai = Carbon::createFromFormat('Y-m-d H:i:s', $pjm->tanggal . ' ' . $pjm->waktu_selesai, 'Asia/Jakarta');
            // Jadikan Berjalan
            if ($now->greaterThanOrEqualTo($waktuMulai) && $now->lessThan($waktuSelesai)) {
                if ($pjm->status !== 'Berjalan') {
                    $pjm->status = 'Berjalan';
                    $pjm->save();
                }
                // Jadikan Selesai
            } elseif ($now->greaterThanOrEqualTo($waktuSelesai)) {
                if ($pjm->status !== 'Selesai') {
                    $pjm->status = 'Selesai';
                    $pjm->save();
                }
            }
        }

        //  Order by DESC
        $pinjaman = Peminjaman::orderBy('tanggal', 'desc')->orderBy('waktu_mulai', 'desc')->paginate(10);

        // Search
        $keyword = $request->input('keyword');
        $jadwal = Peminjaman::query()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('waktu_mulai', 'like', "%{$keyword}%")
                    ->orWhere('lab_id', 'like', "%{$keyword}%")
                    ->orWhere('tanggal', 'like', "%{$keyword}%")
                    ->orWhere('status', 'like', "%{$keyword}%");
            })
            ->orderBy('tanggal', 'desc')
            ->orderBy('waktu_mulai', 'desc')
            ->paginate(10);
        return view('pinjaman', compact('pinjaman', 'jadwal'));
    }

    // view form peminjaman lab
    public function form_peminjaman()
    {
        $user = User::where('role_id', '3')->orderBy('name', 'asc')->get();
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $lab = Lab::where('status', 'Tersedia')->get();

        return view('formPeminjaman', compact('user', 'kelas', 'lab'));
    }

    public function create_peminjaman(Request $request)
    {
        $validate = $request->validate([
            'lab_id' => 'required|not_in:tidak tersedia',
            'user_id' => 'required',
            'kelas_id' => 'required',
            'mata_pelajaran' => 'required',
            'tanggal' => 'required|after_or_equal:' . Carbon::today()->toDateString(),
            'waktu_mulai' => 'required|after:now',
            'waktu_selesai' => 'required|after:waktu_mulai',
        ]);

        DB::beginTransaction();
        try {

            $jadwal_bentrok = Peminjaman::where('lab_id', $request->lab_id)
                ->where('tanggal', $request->tanggal)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                        ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai]);
                })->exists();

            if ($jadwal_bentrok) {
                return redirect()->back()->with('error', 'Jadwal bentrok dengan peminjaman yang sudah ada.');
            }
            $peminjaman = new Peminjaman();
            $peminjaman->lab_id = $request->lab_id;
            $peminjaman->user_id = $request->user_id;
            $peminjaman->kelas_id = $request->kelas_id;
            $peminjaman->mata_pelajaran = $request->mata_pelajaran;
            $peminjaman->tanggal = $request->tanggal;
            $peminjaman->waktu_mulai = $request->waktu_mulai;
            $peminjaman->waktu_selesai = $request->waktu_selesai;
            $peminjaman->status = 'Dijadwalkan';
            $peminjaman->save();

            DB::commit();
            return redirect()->route('peminjaman.view')->with('success', 'Berhasil mengajukan jadwal peminjaman LAB');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengajukan jadwal peminjaman LAB');
        }
    }

    public function edit_peminjaman($id): View
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = User::where('role_id', '3')->orderBy('name', 'desc')->get();
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $lab = Lab::where('status', 'Tersedia')->get();

        return view('editPeminjaman', compact('user', 'kelas', 'lab', 'peminjaman'));
    }

    public function update_peminjaman(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'lab_id' => 'required|not_in:Tidak tersedia',
            'user_id' => 'required',
            'kelas_id' => 'required',
            'mata_pelajaran' => 'required',
            'tanggal' => 'required|after_or_equal:' . Carbon::today()->toDateString(),
            'waktu_mulai' => 'required|after:now',
            'waktu_selesai' => 'required|after:waktu_mulai',
        ]);

        if($validator->fails()){
            return back()->with('error', $validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $jadwal_bentrok = Peminjaman::where('lab_id', $request->lab_id)
                ->where('tanggal', $request->tanggal)
                ->where('id', '!=', $id)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                        ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai]);
                })->exists();

            if ($jadwal_bentrok) {
                return redirect()->back()->with('error', 'Jadwal bentrok dengan peminjaman yang sudah ada.');
            }
            $peminjaman->lab_id = $request->lab_id;
            $peminjaman->user_id = $request->user_id;
            $peminjaman->kelas_id = $request->kelas_id;
            $peminjaman->mata_pelajaran = $request->mata_pelajaran;
            $peminjaman->tanggal = $request->tanggal;
            $peminjaman->waktu_mulai = $request->waktu_mulai;
            $peminjaman->waktu_selesai = $request->waktu_selesai;
            $peminjaman->status = $request->status;
            $peminjaman->save();

            DB::commit();
            return redirect()->route('peminjaman.view')->with('success', 'Berhasil update jadwal peminjaman LAB');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal update jadwal peminjaman LAB');
        }
    }

    public function delete($id)
    {
        $lab = Jadwal::findOrFail($id);

        DB::beginTransaction();
        try {
            $lab->delete();

            if (!$lab) {
                return redirect()->back()->with('error', 'Gagal hapus Jadwal LAB (jadwal tidak ditemukan)');
            }
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil hapus Jadwal LAB');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal hapus Jadwal LAB kons');
        }
    }
}
