<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPengajuan;
use App\Models\FormulirKunjungan;
use App\Models\PengajuanKunjungan; // Tambahkan use statement untuk model PengajuanKunjungan

class DetailPengajuanController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel PengajuanKunjungan
        $data = PengajuanKunjungan::all();
        return view('login.detailpengajuan', compact('data'));
    }

    public function edit(Request $request, $id)
    {
        // Mengambil data PengajuanKunjungan berdasarkan ID
        $data = PengajuanKunjungan::find($id);

        return view ('login.editformulir',compact('data'));
        
        // Lakukan proses edit data sesuai kebutuhan
        // ...
        
        // Redirect atau kembalikan response sesuai kebutuhan
        // ...
    }
}
