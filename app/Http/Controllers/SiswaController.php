<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function listSiswa(Request $request)
    {
        $cariSiswa = $request->input('cari');
        if ($cariSiswa) {
            $users = User::where('role_id', [4])
                ->where(function ($query) use ($cariSiswa) {
                    $query->where('name', 'LIKE', "%{$cariSiswa}%")
                        ->orWhere('email', 'LIKE', "%{$cariSiswa}%");
                })
                ->paginate(15);
        } else {
            $users = DB::table('users')
                ->leftJoin('kelas', 'users.kelas_id', '=', 'kelas.id')
                ->where('role_id', 4)
                ->orderBy('kelas.nama_kelas', 'asc')
                ->get([
                    'users.id',
                    'users.kelas_id',
                    'users.name',
                    DB::raw('COALESCE(kelas.nama_kelas, "Tidak Ada Kelas") as nama_kelas'),
                    'users.email',
                    'users.nomor_telepon',
                    'users.alamat',
                    'users.jenis_kelamin'
                ]);
            ;
        }

        $siswa = DB::table('users')
            ->leftJoin('kelas', 'users.kelas_id', '=', 'kelas.id')
            ->where('role_id', 4)
            ->orderBy('kelas.nama_kelas', 'asc')
            ->get([
                'users.id',
                'users.kelas_id',
                'users.name',
                DB::raw('COALESCE(kelas.nama_kelas, "Tidak Ada Kelas") as nama_kelas'),
                'users.email',
                'users.nomor_telepon',
                'users.alamat',
                'users.jenis_kelamin'
            ]);

        $user = User::all();
        $kelas = Kelas::all();
        $kelas7 = DB::table('users')
            ->join('kelas', 'users.kelas_id', '=', 'kelas.id')
            ->select('kelas.nama_kelas', DB::raw('COUNT(users.id) as jumlah_siswa'))
            ->where(function ($query) {
                $query->where('kelas.nama_kelas', 'LIKE', '7%');
            })
            ->groupBy('kelas.nama_kelas')
            ->first();


        $kelass8 = DB::table('users')
            ->join('kelas', 'users.kelas_id', '=', 'kelas.id')
            ->select('kelas.nama_kelas', DB::raw('COUNT(users.id) as jumlah_siswa'))
            ->where(function ($query) {
                $query->where('kelas.nama_kelas', 'LIKE', '8%');
            })
            ->groupBy('kelas.nama_kelas')->first();

        $kelas9 = DB::table('users')
            ->join('kelas', 'users.kelas_id', '=', 'kelas.id')
            ->select('kelas.nama_kelas', DB::raw('COUNT(users.id) as jumlah_siswa'))
            ->where(function ($query) {
                $query->where('kelas.nama_kelas', 'LIKE', '9%');
            })
            ->groupBy('kelas.nama_kelas')->first();
        return view('kepala_lab.siswa', compact('siswa', 'kelas', 'user', 'kelas7', 'kelass8', 'kelas9', 'users'));
    }

    public function createSiswa(Request $request)
    {
        $request->validate([
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'name' => ['required', 'max:255'],
            'password' => ['required'],
            'kelas_id' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $siswa = new User;
            $siswa->name = $request->input('name');
            $siswa->email = $request->input('email');
            $siswa->password = Hash::make($request->input('password'));
            $siswa['role_id'] = 4;
            $siswa->foto_profil = '';
            $siswa->kelas_id = $request->input('kelas_id');
            $siswa->save();
            DB::commit();
            return Redirect::route('siswa.view')->with('success', 'Berhasil menambahkan Siswa');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::back()->with('error', $th->getMessage());
        }
    }

    public function updateSiswa(Request $request, $id)
    {
        $findSiswa = User::find($id);
        $request->validate([
            'email' => ['required', 'max:255', 'email', Rule::unique('users', 'email')->ignore($findSiswa->id)],
            'name' => ['required', 'max:255'],
            'kelas_id' => ['required']
        ]);

        DB::beginTransaction();

        try {
            $findSiswa->name = $request->input('name');
            $findSiswa->email = $request->input('email');
            $findSiswa->kelas_id = $request->input('kelas_id');
            $findSiswa->alamat = $request->input('alamat');
            $findSiswa->jenis_kelamin = $request->input('jenis_kelamin');
            $findSiswa->tanggal_lahir = $request->input('tanggal_lahir');
            $findSiswa->save();

            DB::commit();
            return Redirect::route('siswa.view')->with('success', 'Berhasil memperbarui data siswa');
        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::back()->with('error', $th->getMessage());
        }

    }

    public function deleteSiswa($id)
    {
        $siswa = User::where('role_id', 4)->where('id', $id);

        if ($siswa) {
            $siswa->delete();
            return redirect()->back()->with('success', 'Berhasil Hapus Siswa!');
        } else {
            return redirect()->back()->with('error', 'Gagal Hapus Siswa!');
        }
    }
}
