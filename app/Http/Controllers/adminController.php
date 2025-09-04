<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use Exception;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function formRegister()
    {
        return view('register');
    }

    public function formLogin()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // simpan ke session
           session(['admin_id' => $admin->id, 'admin_username' => $admin->username, 'admin_role'=> $admin->role]);
            return redirect()->route('home');
        }
        return back()->with('error', 'Username atau password salah.');
    }

    public function prosesRegister(Request $request) {
    try {
        $request->validate([
            'username' => 'required|string|max:50|unique:dataadmin,username',
            'password' => 'required|string|min:8',
            'role'     => 'required|string|in:admin,guru,siswa',
        ]);

        // Simpan ke dataadmin
        $admin = admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        // Kalau siswa → buat baris di datasiswa pakai input
        if ($request->role === 'siswa') {
            \App\Models\siswa::create([
                'id'   => $admin->id,  // FK ke dataadmin
                'nama' => $request->nama_siswa ?? null,
                'tb'   => $request->tb ?? null,
                'bb'   => $request->bb ?? null,
            ]);
        }

        // Kalau guru → buat baris di dataguru pakai input
        if ($request->role === 'guru') {
            \App\Models\guru::create([
                'id'    => $admin->id, // FK ke dataadmin
                'nama'  => $request->nama_guru,
                'mapel' => $request->mapel,
            ]);
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Registrasi gagal: '.$e->getMessage());
    }
}




    public function logout()
    {
        //hapus session
        session()->forget(['admin_id', 'admin_username']);
        return redirect()->route('landing');
    }
}

 