<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Lab View
    public function lab_view(): View
    {
        $lab = Lab::all();
        return view('kepala_lab.lab', compact('lab'));
    }

    // Create Lab 
    public function create_lab(Request $request)
    {
        $validate = $request->validate([
            'nama_lab'=>'required',
            'kapasitas'=>'required',
            'fasilitas'=>'required',
            'status'=>'required',
        ]);

        DB::beginTransaction();
        try {
            $lab = new Lab();
            $lab->nama_lab = $request->nama_lab;
            $lab->kapasitas = $request->kapasitas;
            $lab->fasilitas = $request->fasilitas;
            $lab->status = $request->status;
            $lab->save();

            DB::commit();
            return redirect()->back()->with('success','Berhasil menambahkan LAB baru');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Gagal menambahkan LAB baru');
        }
    }

    // Update Lab
    public  function update_lab(Request $request, $id)
    {
        $lab = Lab::findOrFail($id);
        $validate = $request->validate([
            'nama_lab'=>'required|unique:lab,nama_lab,'.$lab->id,
            'kapasitas'=>'required',
            'fasilitas'=>'required',
            'status'=>'required',
        ]);

        DB::beginTransaction();
        try {
            $lab->nama_lab = $request->nama_lab;
            $lab->kapasitas = $request->kapasitas;
            $lab->fasilitas = $request->fasilitas;
            $lab->status = $request->status ?? 'tersedia';
            $lab->save();

            DB::commit();
            return redirect()->back()->with('success','Berhasil Update data LAB ');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Gagal menambahkan LAB baru');
        }
    }

    // Delete LAB
    public function delete_lab($id)
    {
        $lab = Lab::findOrFail($id);
        
        DB::beginTransaction();
        try {
            if($lab){
                $lab->delete();
            }

            DB::commit();
            return redirect()->back()->with('success','Berhasil hapus LAB ');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Gagal menemukan LAB ');        
        }
    }

    // Search
    public function search(Request $request)
    {
        $keyword = $request->input('table-search');

        $lab = Lab::query()
        ->where('nama_lab', 'LIKE', "%{$keyword}%")
        ->orWhere('kapasitas', 'LIKE', "%{$keyword}%")
        ->orWhere('fasilitas', 'LIKE', "%{$keyword}%")
        ->orWhere('status', 'LIKE', "%{$keyword}%")
        ->get();

        return view('kepala_lab.lab', compact('lab'));

    }
}
