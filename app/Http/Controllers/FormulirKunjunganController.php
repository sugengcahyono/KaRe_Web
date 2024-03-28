<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormulirKunjungan;

class FormulirKunjunganController extends Controller
{
    public function index()
    {
        $pengajuan_kunjungan = FormulirKunjungan::latest()->paginate(5);

        return view('login.formulirkunjungan', compact('pengajuan_kunjungan'));
    }

    public function show()
    {
        $data = FormulirKunjungan::all();
        return view('formulirkunjungan', compact('data'));
    }


    public function create()
    {
        return view('login.formulirkunjungan');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari formulir
        $request->validate([
            'nama' => 'required|max:50',
            'asal' => 'required|max:20',
            'nama_instansi' => 'required|max:50',
            'nomor_telepon' => 'required|numeric',
            'tanggal' => 'required|date',
            'tujuan_kunjungan' => 'required|max:50',
            'jumlah_orang' => 'required|integer',
        ]);

        $pengajuan_kunjungan = new FormulirKunjungan();
        $pengajuan_kunjungan->nama_kunjungan = $request->input('nama');
        $pengajuan_kunjungan->alamat_kunjungan = $request->input('asal');
        $pengajuan_kunjungan->nama_instansi_kunjungan = $request->input('nama_instansi');
        $pengajuan_kunjungan->no_hp_kunjungan = $request->input('nomor_telepon');
        $pengajuan_kunjungan->tanggal_kunjungan = $request->input('tanggal');
        $pengajuan_kunjungan->tujuan_kunjungan = $request->input('tujuan_kunjungan');
        $pengajuan_kunjungan->jumlah_kunjungan = $request->input('jumlah_orang');
        $pengajuan_kunjungan->save();

        // Redirect pengguna setelah pengguna berhasil ditambahkan
        return redirect()->route('detailpengajuan')->with('success', 'Pengajuan Berhasil Dilakukan');
    }

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
            'jumlah_kunjungan' => $request->jumlah_orang,
 
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
