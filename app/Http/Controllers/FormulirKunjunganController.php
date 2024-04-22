<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormulirKunjungan;
use App\Models\User;


class FormulirKunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = FormulirKunjungan::latest()->paginate(5);

        return view('login.formulirkunjungan', compact('kunjungan'));
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
        $user = auth()->user()->id_user;

        $kunjungan = new FormulirKunjungan();
        $kunjungan->nama_kunjungan = $request->input('nama');
        $kunjungan->alamat_kunjungan = $request->input('asal');
        $kunjungan->namainstansi_kunjungan = $request->input('nama_instansi');
        $kunjungan->nohp_kunjungan = $request->input('nomor_telepon');
        $kunjungan->tgl_kunjungan = $request->input('tanggal');
        $kunjungan->tujuan_kunjungan = $request->input('tujuan_kunjungan');
        $kunjungan->jumlahorang_kunjungan = $request->input('jumlah_orang');
        $kunjungan->id_user = $user;
        $kunjungan->save();

        // Redirect pengguna setelah pengguna berhasil ditambahkan
        return redirect()->route('detailpengajuan')->with('success', 'Pengajuan Berhasil Dilakukan');
    }

    public function edit(Request $request, $id)
    {

        $kunjungan = FormulirKunjungan::find($id);
        // return $pengajuan_kunjungan;
        return view('login.editformulir', compact('kunjungan'));
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

        $kunjungan = FormulirKunjungan::findOrFail($id);
        $kunjungan->update([


            'nama_kunjungan' => $request->nama,
            'alamat_kunjungan' => $request->asal,
            'namainstansi_kunjungan' => $request->nama_instansi_kunjungan,
            'nohp_kunjungan' => $request->nomor_telepon,
            'tgl_kunjungan' => $request->tanggal,
            'tujuan_kunjungan' => $request->tujuan_kunjungan,
            'jumlahorang_kunjungan' => $request->jumlah_orang,
 
        ]);

        // Redirect pengguna setelah pengguna berhasil diubah

        return redirect()->back()->with('success', 'Data Berhasil Diedit');

        // return redirect()->route('detailpengajuan')->with('success', 'Data Berhasil Diedit');
    }
    public function destroy(int $id)
    {
        $kunjungan = FormulirKunjungan::findOrFail($id);
        $kunjungan->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
