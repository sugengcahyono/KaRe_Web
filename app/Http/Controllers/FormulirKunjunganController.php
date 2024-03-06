<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormulirKunjungan;
use App\Models\PengajuanKunjungan;

class FormulirKunjunganController extends Controller
{
    public function index()
    {
        return view('login.formulirkunjungan');
    }
    public function show()
    {
        $data = FormulirKunjungan::all();
        return view('formulirkunjungan', compact('data'));
    }


    public function create()
    {
        return view('create');
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
            // 'kategori' => 'required',
            'jumlah_orang' => 'required',
        ]);

        $pengajuan_kunjungan = new FormulirKunjungan();
        $pengajuan_kunjungan->nama_kunjungan = $request->input('nama');
        $pengajuan_kunjungan->alamat_kunjungan = $request->input('asal');
        $pengajuan_kunjungan->nama_instansi_kunjungan = $request->input('nama_instansi');
        $pengajuan_kunjungan->no_hp_kunjungan = $request->input('nomor_telepon');
        $pengajuan_kunjungan->tanggal_kunjungan = $request->input('tanggal');
        $pengajuan_kunjungan->tujuan_kunjungan = $request->input('tujuan_kunjungan');
        // $pengajuan_kunjungan->status_kunjungan = $request->input('kategori');
        $pengajuan_kunjungan->alasan_status_kunjungan = $request->input('jumlah_orang');
        $pengajuan_kunjungan->save();

        // Redirect pengguna setelah pengguna berhasil ditambahkan
        return redirect()->route('detailpengajuan')->with('success', 'Pengajuan Berhasil Dilakukan');
    }
    // File: app/Http/Controllers/FormulirKunjunganController.php

    // public function detail($id)
    // {
    //     $pengajuan_kunjungan = FormulirKunjungan::find($id);

    //     if (!$pengajuan_kunjungan) {
    //         return abort(404); // Handle jika ID tidak ditemukan
    //     }

    //     return view('login.detailpengajuan', compact('pengajuan_kunjungan'));
    // }
    public function edit(Request $request, $id)
    {
        
        $pengajuan_kunjungan = FormulirKunjungan::find($id);
            // return $pengajuan_kunjungan;
        return view('login.editformulir', compact('pengajuan_kunjungan'));

        
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'asal' => 'required',
            'nama_instansi_kunjungan' => 'required',
            'nomor_telepon' => 'required',
            'tanggal' => 'required',
            'tujuan_kunjungan' => 'required',
            'jumlah_orang' => 'required',
        ]);
    
        $pengajuan_kunjungan = FormulirKunjungan::findOrFail($id);
        $pengajuan_kunjungan->update([

    
            'nama_kunjungan' => $request->nama,
            'alamat_kunjungan' => $request->asal,
            'nama_instansi_kunjungan' => $request->nama_instansi_kunjungan,
            'no_hp_kunjungan' => $request->nomor_telepon,
            'tanggal_kunjungan' => $request->tanggal,
            'tujuan_kunjungan' => $request->tujuan_kunjungan,
            'alasan_status_kunjungan' => $request->jumlah_orang,
        ]);

        // Redirect pengguna setelah pengguna berhasil diubah

        return redirect()->back()->with('success', 'Data Berhasil Diedit');

        // return redirect()->route('detailpengajuan')->with('success', 'Data Berhasil Diedit');
    }
    public function destroy(int $id)
    {
        $pengajuan_kunjungan = FormulirKunjungan::findOrFail($id);
        $pengajuan_kunjungan->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');

    }
}


