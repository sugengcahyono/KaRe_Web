<?php

namespace App\Http\Controllers\MobileApi;

use App\Models\FormulirKunjungan; // Mengimpor model Kunjungan yang benar
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MobileKunjunganController extends Controller
{
    public function KunjunganDiajukan()
{
    // Mengambil data kunjungan dengan status kunjungan diajukan, diurutkan berdasarkan waktu pembuatan atau pembaruan kunjungan secara menurun
    $kunjunganDiajukan = FormulirKunjungan::where('status_kunjungan', 'diajukan')
                                            ->orderBy('created_at', 'desc')
                                            ->get();

    // Mengembalikan data kunjungan dalam format JSON
    return response()->json([
        'success' => true,
        'data' => $kunjunganDiajukan
    ]);
}

public function KunjunganDitolak()
{
    // Mendapatkan bulan dan tahun saat ini
    $bulanIni = date('m');
    $tahunIni = date('Y');

    // Mengambil data kunjungan dengan status kunjungan ditolak pada bulan ini, diurutkan berdasarkan waktu pembuatan atau pembaruan kunjungan secara menurun
    $kunjunganDitolak = FormulirKunjungan::where('status_kunjungan', 'ditolak')
                                            ->whereMonth('created_at', $bulanIni)
                                            ->whereYear('created_at', $tahunIni)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

    // Mengembalikan data kunjungan dalam format JSON
    return response()->json([
        'success' => true,
        'data' => $kunjunganDitolak
    ]);
}

public function KunjunganDiterima()
{
    // Mendapatkan bulan dan tahun saat ini
    $bulanIni = date('m');
    $tahunIni = date('Y');

    // Mengambil data kunjungan dengan status kunjungan diterima pada bulan ini, diurutkan berdasarkan waktu pembuatan atau pembaruan kunjungan secara menurun
    $kunjunganDiterima = FormulirKunjungan::where('status_kunjungan', 'diterima')
                                            ->whereMonth('created_at', $bulanIni)
                                            ->whereYear('created_at', $tahunIni)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

    // Mengembalikan data kunjungan dalam format JSON
    return response()->json([
        'success' => true,
        'data' => $kunjunganDiterima
    ]);
}



    public function terimaKunjungan(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
        ]);

        // Jika validasi gagal, kirim respon dengan pesan error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Update status kunjungan menjadi 'Diterima' di database
        $kunjungan = FormulirKunjungan::find($request->id_kunjungan);
        $kunjungan->status_kunjungan = 'Diterima';
        $kunjungan->save();

        // Kirim respon berhasil
        return response()->json(['message' => 'Kunjungan diterima'], 200);
    }

    public function tolakKunjungan(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'alasanstatus_kunjungan' => 'required|string',
        ]);

        // Jika validasi gagal, kirim respon dengan pesan error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Update status kunjungan menjadi 'Ditolak' dan masukkan alasan ditolak di database
        $kunjungan = FormulirKunjungan::find($request->id_kunjungan);
        $kunjungan->status_kunjungan = 'Ditolak';
        $kunjungan->alasanstatus_kunjungan = $request->alasanstatus_kunjungan;
        $kunjungan->save();

        // Kirim respon berhasil
        return response()->json(['message' => 'Kunjungan ditolak'], 200);
    }   

    public function getRiwayatKunjungan(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'bulan' => 'required|integer|between:1,12',
        'tahun' => 'required|integer|min:2000|max:9999',
    ]);

    // Jika input tidak valid, kembalikan response dengan status 400
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    // Ambil data dari input
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    // Query untuk mengambil data kunjungan berdasarkan bulan dan tahun
    $kunjungan = FormulirKunjungan::whereMonth('tgl_kunjungan', $bulan)
        ->whereYear('tgl_kunjungan', $tahun)
        ->get();

    // Jika data ditemukan, kembalikan response dengan status 200 dan data kunjungan
    if ($kunjungan->isNotEmpty()) {
        return response()->json(['kunjungan' => $kunjungan], 200);
    } else {
        // Jika tidak ada data, kembalikan response dengan status 404
        return response()->json(['message' => 'Kunjungan not found'], 404);
    }
}



    // public function searchKunjungan(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'search' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }

    //     $search = $request->input('search');

    //     $kunjungan = FormulirKunjungan::where('nama_kunjungan', 'LIKE', "%$search%")
    //         ->orWhere('alamat_kunjungan', 'LIKE', "%$search%")
    //         ->orWhere('tgl_kunjungan', 'LIKE', "%$search%")
    //         ->get();

    //     return response()->json($kunjungan);
    // }

}
