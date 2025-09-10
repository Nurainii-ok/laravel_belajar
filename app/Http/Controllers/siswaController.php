<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;

class SiswaController extends Controller
{
    public function home() {
        if (!session()->has('admin_id')) {
            return redirect()->route('login');
        }

        $admin = \App\Models\admin::with(['siswa', 'guru'])->find(session('admin_id'));

        $siswa = \App\Models\siswa::all(); // tetap untuk tabel CRUD siswa

        return view('home', compact('admin', 'siswa'));
    }


    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        // validasi sederhana (opsional)
        $request->validate([
            'nama' => 'required|string|max:100',
            'tb'   => 'required|numeric',
            'bb'   => 'required|numeric',
        ]);

        // simpan data siswa + id admin yang login
        Siswa::create([
            'nama' => $request->nama,
            'tb'   => $request->tb,
            'bb'   => $request->bb,
            'id'   => session('admin_id') // isi otomatis id admin yg login
        ]);

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $idsiswa) {
        $request->validate([
            'nama' => 'required|string|max:100',
            'tb'   => 'required|numeric',
            'bb'   => 'required|numeric',
        ]);

        $siswa = Siswa::findOrFail($idsiswa);
        $siswa->nama = $request->nama;
        $siswa->tb   = $request->tb;
        $siswa->bb   = $request->bb;
        $siswa->save();

        return redirect()->route('home')->with('success', 'Data siswa berhasil diupdate');
    }


    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('home');
    }
}
