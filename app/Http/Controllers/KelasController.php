<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // View Kelas
    public function kelas_view(Request $request):View
    {
        $keyword = $request->input('kelas');

        $kelas = Kelas::query()
                ->where('nama_kelas', 'LIKE' ,"%{$keyword}%")
                ->orderBy('nama_kelas','asc')->get();
        return view('kepala_lab.kelas', compact('kelas'));
    }

    // Create kelas
    public function create_kelas(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
            'wali_kelas' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $newKelas = new Kelas();
            $newKelas->nama_kelas = $request->nama_kelas;
            $newKelas->wali_kelas = $request->wali_kelas;
            $newKelas->save();

            DB::commit();
            return redirect()->back()->with('success','Berhasil menambahkan kelas baru');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Gagal menambahkan kelas!');
        }
    }

    // Update kelas
    public function update_kelas(Request $request, $id)
    {
        $updateKelas =  Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas' => ['required','unique:kelas,nama_kelas,' . $updateKelas->id],
            
            'wali_kelas' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $updateKelas->nama_kelas = $request->nama_kelas;
            $updateKelas->wali_kelas = $request->wali_kelas;
            $updateKelas->save();
            DB::commit();
            return redirect()->back()->with('success','Berhasil Update data kelas ');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Gagal Update nama kelas!');
        }
    }

    // Delete kelas 
    public function delete_kelas($id)
    {
        $hapus = Kelas::findOrFail($id);

        DB::beginTransaction();
        try {
            if($hapus){
                $hapus->delete();
            }
            DB::commit();
            return redirect()->back()->with('success','Berhasil hapus data kelas ');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Gagal Hapus kelas!');
        }
    }
}
