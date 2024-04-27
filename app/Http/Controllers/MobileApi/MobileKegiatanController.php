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


    public function getDetailKegiatan(Request $request)
{
    try {
        // Periksa apakah request memiliki id_kegiatan
        if ($request->has('id_kegiatan')) {
            // Dapatkan id_kegiatan dari request
            $id_kegiatan = $request->id_kegiatan;
            
            // Cari kegiatan berdasarkan id
            $kegiatan = Kegiatan::find($id_kegiatan);
            
            // Jika kegiatan ditemukan
            if ($kegiatan) {
                // Buat respons JSON dengan detail kegiatan
                $response = [
                    'status' => 'success',
                    'data' => $kegiatan
                ];
            } else {
                // Jika kegiatan tidak ditemukan, kirim pesan kegagalan dalam respons JSON
                $response = [
                    'status' => 'error',
                    'message' => 'Kegiatan tidak ditemukan'
                ];
            }
        } else {
            // Jika request tidak memiliki id_kegiatan, kirim pesan kegagalan dalam respons JSON
            $response = [
                'status' => 'error',
                'message' => 'ID Kegiatan tidak diberikan'
            ];
        }
        
        // Kembalikan respons JSON
        return response()->json($response);
    } catch (\Exception $e) {
        // Tangkap kesalahan dan kirim pesan kesalahan dalam respons JSON
        $response = [
            'status' => 'error',
            'message' => 'Gagal mendapatkan detail kegiatan: ' . $e->getMessage()
        ];
        return response()->json($response, 500);
    }
}

public function updateKegiatan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_kegiatan' => 'required|integer',
            'nama_kegiatan' => 'nullable|string',
            'deskripsi_kegiatan' => 'nullable|string',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Pastikan foto adalah file gambar dengan format yang valid dan ukuran maksimum 2MB
            'id_user' => 'required|integer', // Pastikan id_user adalah bilangan bulat
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        // Cari kegiatan berdasarkan id
        $kegiatan = Kegiatan::find($request->id_kegiatan);

        // Jika kegiatan tidak ditemukan
        if (!$kegiatan) {
            return response()->json(['status' => 'error', 'message' => 'Kegiatan tidak ditemukan'], 404);
        }

        // Perbarui data kegiatan
        if ($request->has('nama_kegiatan')) {
            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        }
        if ($request->has('deskripsi_kegiatan')) {
            $kegiatan->deskripsi_kegiatan = $request->deskripsi_kegiatan;
        }
        if ($request->hasFile('foto_kegiatan')) {
            $foto_kegiatan = $request->file('foto_kegiatan');
            $namaFile = uniqid() . '_' . $foto_kegiatan->getClientOriginalName();
            $foto_kegiatan->move(public_path('Images/Kegiatan'), $namaFile);
            $kegiatan->foto_kegiatan = $namaFile;
        }

        // Simpan perubahan
        $kegiatan->save();

        // Beri respons berhasil
        return response()->json(['status' => 'success', 'message' => 'Data kegiatan berhasil diperbarui'], 200);
    }

    public function DeleteKegiatan(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'id_kegiatan' => 'required|integer'
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid input data',
                'errors' => $validator->errors()
            ], 400);
        }

        // Ambil ID kegiatan dari request
        $idKegiatan = $request->input('id_kegiatan');

        try {
            // Hapus kegiatan berdasarkan ID
            Kegiatan::where('id_kegiatan', $idKegiatan)->delete();

            // Jika berhasil dihapus
            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan berhasil dihapus.'
            ], 200);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kegiatan: ' . $e->getMessage()
            ], 500);
        }
    }





}
