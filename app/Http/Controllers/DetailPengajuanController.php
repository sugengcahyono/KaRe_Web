<?php

namespace App\Http\Controllers;

use App\Models\FormulirKunjungan;
class DetailPengajuanController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel PengajuanKunjungan
        $data = FormulirKunjungan::all();
        return view('login.detailpengajuan', compact('data'));
    }

    
}
