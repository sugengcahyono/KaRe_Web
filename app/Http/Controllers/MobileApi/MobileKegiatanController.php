<?php

namespace App\Http\Controllers\MobileApi;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MobileKegiatanController extends Controller
{
    public function UploadKegiatan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
            'deskripsi_kegiatan' => 'required',
            'foto_kegiatan' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Pastikan foto adalah file gambar dengan format yang valid dan ukuran maksimum 2MB
            'id_user' => 'required|integer', // Pastikan id_user adalah bilangan bulat
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        // Ambil data dari form
        $judul = $request->input('nama_kegiatan');
        $deskripsi = $request->input('deskripsi_kegiatan');
        $idUser = $request->input('id_user');
        $fotoKegiatan = $request->file('foto_kegiatan');

        // Simpan foto kegiatan di KaRe_Web\public\Images\Kegiatan dengan nama yang unik
        $namaFile = uniqid() . '_' . $fotoKegiatan->getClientOriginalName();
        $fotoKegiatan->move(public_path('Images/Kegiatan'), $namaFile);

        // Simpan data kegiatan ke dalam database
        $kegiatan = new Kegiatan();
        $kegiatan->nama_kegiatan = $judul;
        $kegiatan->deskripsi_kegiatan = $deskripsi;
        $kegiatan->foto_kegiatan = $namaFile;
        $kegiatan->id_user = $idUser;

        // Jika gagal menyimpan kegiatan
        if (!$kegiatan->save()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan kegiatan'], 500);
        }

        // Buat respons JSON
        $response = ['status' => 'success', 'message' => 'Kegiatan berhasil diunggah'];

        // Tampilkan respons JSON
        return response()->json($response);
    }

    public function getAllKegiatan()
    {
        // Ambil semua data kegiatan
        $kegiatans = Kegiatan::all();

        // Jika tidak ada data kegiatan yang ditemukan
        if ($kegiatans->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Tidak ada kegiatan yang ditemukan'], 404);
        }

        // Buat respons JSON
        return response()->json(['status' => 'success', 'kegiatans' => $kegiatans]);
    }


    public function getDetailKegiatan($idKegiatan)
    {
        try {
            // Cari kegiatan berdasarkan id
            $kegiatan = Kegiatan::find($idKegiatan);
            
            // Jika kegiatan ditemukan
            if ($kegiatan) {
                // Buat respons JSON dengan detail kegiatan
                $response = [
                    'status' => 'success',
                    'data' => $kegiatan
                ];
            } else {
                // Jika kegiatan tidak ditemukan
                $response = [
                    'status' => 'error',
                    'message' => 'Kegiatan tidak ditemukan'
                ];
            }
            
            // Kembalikan respons JSON
            return response()->json($response);
        } catch (\Exception $e) {
            // Tangkap kesalahan dan kembalikan respons JSON dengan pesan kesalahan
            return response()->json(['status' => 'error', 'message' => 'Gagal mendapatkan detail kegiatan: ' . $e->getMessage()], 500);
        }
    }
}
