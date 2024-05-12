<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // View Kelas
    public function kelas_view(Request $request): View
    {
        abort_if(Auth::user()->role_id == 4, 403, 'Kamu tidak memiliki akses');

        $cariKelas = $request->input('query');
        $kelasQuery = Kelas::orderBy('nama_kelas', 'ASC');
        if ($cariKelas) {
            $kelasQuery = Kelas::where('nama_kelas', 'LIKE', "%$cariKelas%");
        }

        $kelas = $kelasQuery->paginate(10);

        $siswa = User::where('role_id', '4')->count();
        $laki = User::where('jenis_kelamin', 'Laki-laki')->count();
        $cewe = User::where('jenis_kelamin', 'Perempuan')->count();

        $totalSiswaPerKelas = User::where('role_id', 4)
            ->select('kelas_id', \DB::raw('count(*) as total_siswa'))
            ->groupBy('kelas_id')
            ->pluck('total_siswa', 'kelas_id');


        return view('kepala_lab.kelas', compact('kelas', 'siswa', 'laki', 'cewe', 'totalSiswaPerKelas'));
    }

    //Daftar siswa berdasarkan kelas
    public function getSiswaByKelas($id): View
    {
        $kelas = Kelas::findOrFail($id);
        $siswa = User::where('kelas_id', $id)->where('role_id', 4)->get();
        return view('kepala_lab.kelassiswa', compact('siswa', 'kelas'));
    }

    // Create kelas
    public function create_kelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
            'wali_kelas' => 'required',
        ]);

        try {
            $newKelas = new Kelas();
            $newKelas->nama_kelas = $request->input('nama_kelas');
            $newKelas->wali_kelas = $request->input('wali_kelas');
            $newKelas->save();
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menambahkan kelas baru');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    // Update kelas
    public function update_kelas(Request $request, $id)
    {
        $updateKelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas' => ['required', 'unique:kelas,nama_kelas,' . $updateKelas->id],

            'wali_kelas' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $updateKelas->nama_kelas = $request->nama_kelas;
            $updateKelas->wali_kelas = $request->wali_kelas;
            $updateKelas->save();
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil Update data kelas ');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Update nama kelas!');
        }
    }

    // Delete kelas 
    public function delete_kelas($id)
    {
        $hapus = Kelas::findOrFail($id);

        DB::beginTransaction();
        try {
            if ($hapus) {
                $hapus->delete();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil hapus data kelas ');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function CariKelas(Request $request)
    {
        $keyword = $request->input('kelas');

        $hasilCari = Kelas::query()
            ->where('nama_kelas', 'LIKE', "%{$keyword}%")
            ->orderBy('nama_kelas', 'asc')->get();

        return view('kepala_lab.kelas', compact('hasilCari'));
    }
}
