<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\guru;
use App\Models\siswa;
use App\Models\walas;
use App\Models\kelas;
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
            session([
                'admin_id'       => $admin->id,
                'admin_username' => $admin->username,
                'admin_role'     => $admin->role
            ]);
            return redirect()->route('home');
        }
        return back()->with('error', 'Username atau password salah.');
    }

    public function prosesRegister(Request $request)
    {
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

            // Kalau siswa → buat baris di datasiswa
            if ($request->role === 'siswa') {
                siswa::create([
                    'id'   => $admin->id,  // FK ke dataadmin
                    'nama' => $request->nama_siswa ?? null,
                    'tb'   => $request->tb ?? null,
                    'bb'   => $request->bb ?? null,
                ]);
            }

            // Kalau guru → buat baris di dataguru
            if ($request->role === 'guru') {
                guru::create([
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

    public function home()
    {
        // ambil admin login
        $admin = admin::with(['siswa', 'guru'])->find(session('admin_id'));

        $siswa = [];
        $walas = null;
        $kelas = null;
        $isWalas = false;

        if ($admin->role === 'admin') {
            // admin lihat semua siswa
            $siswa = siswa::all();
        }

        if ($admin->role === 'guru' && $admin->guru) {
            // cek guru apakah walas
            $walas = walas::where('idguru', $admin->guru->idguru)
                          ->with('kelas.siswa')
                          ->first();
            $isWalas = $walas ? true : false;
        }

        if ($admin->role === 'siswa' && $admin->siswa) {
            // cari kelas siswa
            $kelas = kelas::where('idsiswa', $admin->siswa->idsiswa)
                          ->with('walas.guru')
                          ->first();
        }

        return view('home', compact('admin', 'siswa', 'walas', 'kelas', 'isWalas'));
    }

    public function logout()
    {
        //hapus session
        session()->forget(['admin_id', 'admin_username', 'admin_role']);
        return redirect()->route('landing');
    }
}
