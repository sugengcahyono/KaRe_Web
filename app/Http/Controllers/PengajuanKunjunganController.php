<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanKunjungan;

class FormulirKunjunganController extends Controller
{
    public function index()
    {
        return view('login.formulirkunjungan');
    }

    public function showAll()
    {
        $data = PengajuanKunjungan::get();
        return view('index', compact('data'));
    }

    public function create()
    {
        return view('login.formulirkunjungan');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari formulir
        $request->validate([
            'nama' => 'required',
            'asal' => 'required',
            'nama_instansi' => 'required',
            'nomor_telepon' => 'required',
            'tanggal' => 'required',
            'tujuan_kunjungan' => 'required',
            'kategori' => 'required',
            'jumlah_orang' => 'required',
        ]);

        // Simpan data pengajuan kunjungan baru ke dalam tabel database
        $pengajuan_kunjungan = new PengajuanKunjungan();
        $pengajuan_kunjungan->nama = $request->nama;
        $pengajuan_kunjungan->asal = $request->asal;
        $pengajuan_kunjungan->tanggal = $request->tanggal;
        $pengajuan_kunjungan->nama_instansi = $request->nama_instansi;
        $pengajuan_kunjungan->nomor_telepon = $request->nomor_telepon;
        $pengajuan_kunjungan->tujuan_kunjungan = $request->tujuan_kunjungan;
        $pengajuan_kunjungan->kategori = $request->kategori;
        $pengajuan_kunjungan->jumlah_orang = $request->jumlah_orang;

        // Simpan data ke dalam tabel database
        $pengajuan_kunjungan->save();

        // Redirect pengguna setelah pengguna berhasil ditambahkan
        return redirect()->route('FormulirKunjungan')->with('success', 'Pengajuan Berhasil Dilakukan');
    }
}
