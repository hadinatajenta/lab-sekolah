<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Auth;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Search 
    public function search(Request $request)
    {
        $keyword = $request->input('cari');
        $roles = Roles::all();
        $user = User::query()
            ->where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('email', 'LIKE', "%{$keyword}%")
            ->get();

        if ($user->isEmpty()) {
            return view('kepala_lab.users', compact('roles', 'user'))->with('error', 'User not found');
        }
        return view('kepala_lab.users', compact('user', 'roles'));
    }

    // View users
    public function users_view(Request $request): View
    {
        $user = User::paginate(15);
        $button = $request->input('filter');
        $roles = Roles::all();
        return view('kepala_lab.users', compact('user', 'roles'));
    }

    // Create Users
    public function create_user(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
            'role_id' => ['required']
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->role_id;
        $user->save();

        // dd($user->role_id);

        $roles = Roles::find($user->role_id);
        $roles->jumlah_user = $roles->jumlah_user + 1;
        $roles->save();

        return redirect()->route('pengguna.view')->with('success', 'Berhasil menambahkan user');
    }

    // Update users
    public function update_user(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $users->id],
            // 'password' => ['required', Rules\Password::defaults()],
            'role_id' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $role_lama = $users->role_id;
            $role_baru = $request->role_id;

            $users->name = $request->name;
            $users->email = $request->email;

            if (!empty($request->password)) {
                $users->password = Hash::make($request->password);
            }

            $users->role_id = $request->role_id;
            $users->save();

            if ($role_lama != $role_baru) {
                $rolesLama = Roles::findOrFail($role_lama);
                $rolesLama->jumlah_user = max($rolesLama->jumlah_user - 1, 0);
                $rolesLama->save();

                $rolesBaru = Roles::findOrFail($role_baru);
                $rolesBaru->jumlah_user = $rolesBaru->jumlah_user + 1;
                $rolesBaru->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'User berhasil diupdate!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate user!');
        }
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);

        DB::beginTransaction();
        try {
            $role_id = $user->role_id;

            $user->delete();

            $role = Roles::findOrFail($role_id);
            $role->jumlah_user = max($role->jumlah_user - 1, 0);
            $role->save();

            DB::commit();
            return redirect()->back()->with('success', 'User berhasil dihapus!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus user!' . $th->getMessage());
        }
    }
}
