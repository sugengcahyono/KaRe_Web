<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormulirKunjungan;

class EditFormulirController extends Controller
{
    public function index()
    {
        return view('login.editformulir');
    }

    // public function edit(int $id)
    // {
    //     // Mengambil data formulir kunjungan berdasarkan ID
    //     $data = FormulirKunjungan::findOrFail($id);

    //     // Jika data formulir tidak ditemukan, Anda dapat menangani kasus ini sesuai kebutuhan
    //     // Contoh: return redirect()->back()->with('error', 'Formulir tidak ditemukan');

    //     // Tampilkan halaman untuk mengedit formulir
    //     return view('login.detailpengajuan', compact('data'));
    // }

    public function edit(Request $request, $id)
    {
        // Mengambil data formulir kunjungan berdasarkan ID
        $data = FormulirKunjungan::find($id);

        // Validasi data formulir dari request
        $request->validate([
            'nama' => 'required',
            'asal' => 'required',
            'nama_instansi' => 'required',
            'nomor_telepon' => 'required',
            'tanggal' => 'required',
            'tujuan_kunjungan' => 'required',
            'jumlah_orang' => 'required',
            // Tambahkan aturan validasi sesuai dengan kebutuhan Anda
        ]);

        // Mengambil data yang diinput dari request
        $formData = $request->only(['nama', 'asal', 'nama_instansi', 'nomor_telepon', 'tanggal', 'tujuan_kunjungan', 'jumlah_orang']);

        // Memperbarui data formulir dengan data yang baru
        $data->update($formData);

        // Redirect ke halaman yang sesuai setelah pembaruan
        return redirect()->route('detailpengajuan')->with('success', 'Formulir berhasil diperbarui');
    }
}
