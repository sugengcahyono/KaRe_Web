<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PengajuanKunjunganController extends Controller
{
    //
    public function index()
    {
        $pengajuankunjungan = DB::table('pengajuan_kunjungan')->get();
        return view('pengajuan_kunjungan.index', compact('pengajuankunjungan'));
    }

    public function create()
    {
        return view('pengajuan_kunjungan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            
            // Tambahkan validasi untuk kolom lain
        ]);

        // Simpan data ke database
        DB::table('pengajuan_kunjungan')->insert([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            // Tambahkan kolom lain
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('pengajuan_kunjungan.index')
            ->with('success', 'Pengajuan kunjungan berhasil disimpan');
    }

}

