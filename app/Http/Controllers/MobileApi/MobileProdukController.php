<?php

namespace App\Http\Controllers\MobileApi;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MobileProdukController extends Controller
{
    //MENDAPATKAN KESELURUHAN PRODUK
    public function getAllProduk()
    {
        // Ambil semua data produk
        $produks = Produk::all();
    
        // Jika tidak ada data produk yang ditemukan
        if ($produks->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Tidak ada produk yang ditemukan'], 404);
        }
    
        // Buat respons JSON
        return response()->json(['status' => 'success', 'produks' => $produks]);
    }

    //UPLOAD PRODUK 
    public function UploadProduk(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Pastikan foto adalah file gambar dengan format yang valid dan ukuran maksimum 10MB
            'harga_produk' => 'required|numeric',
            'stok_produk' => 'required|integer',
            'id_user' => 'required|integer', // Pastikan id_user adalah bilangan bulat
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        // Ambil data dari form
        $namaProduk = $request->input('nama_produk');
        $deskripsi = $request->input('deskripsi_produk');
        $hargaProduk = $request->input('harga_produk');
        $stokProduk = $request->input('stok_produk');
        $idUser = $request->input('id_user');
        $fotoProduk = $request->file('foto_produk');

        // Simpan foto produk di KaRe_Web\public\Images\Produk dengan nama yang unik
        $namaFile = uniqid() . '_' . $fotoProduk->getClientOriginalName();
        $fotoProduk->move(public_path('Images/Produk'), $namaFile);

        // Simpan data produk ke dalam database
        $produk = new Produk();
        $produk->nama_produk = $namaProduk;
        $produk->deskripsi_produk = $deskripsi;
        $produk->foto_produk = $namaFile;
        $produk->harga_produk = $hargaProduk;
        $produk->stok_produk = $stokProduk;
        $produk->id_user = $idUser;

        // Jika gagal menyimpan produk
        if (!$produk->save()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan produk'], 500);
        }

        // Buat respons JSON
        $response = ['status' => 'success', 'message' => 'Produk berhasil diunggah'];

        // Tampilkan respons JSON
        return response()->json($response);
    }

    public function getDetailPupuk(Request $request)
    {
        try {
            // Periksa apakah request memiliki id_produk
            if ($request->has('id_produk')) {
                // Dapatkan id_produk dari request
                $id_produk = $request->id_produk;

                // Cari pupuk berdasarkan id
                $pupuk = Produk::find($id_produk);

                // Jika pupuk ditemukan
                if ($pupuk) {
                    // Buat respons JSON dengan detail pupuk
                    $response = [
                        'status' => 'success',
                        'data' => $pupuk
                    ];
                } else {
                    // Jika pupuk tidak ditemukan, kirim pesan kegagalan dalam respons JSON
                    $response = [
                        'status' => 'error',
                        'message' => 'Pupuk tidak ditemukan'
                    ];
                }
            } else {
                // Jika request tidak memiliki id_produk, kirim pesan kegagalan dalam respons JSON
                $response = [
                    'status' => 'error',
                    'message' => 'ID Pupuk tidak diberikan'
                ];
            }

            // Kembalikan respons JSON
            return response()->json($response);
        } catch (\Exception $e) {
            // Tangkap kesalahan dan kirim pesan kesalahan dalam respons JSON
            $response = [
                'status' => 'error',
                'message' => 'Gagal mendapatkan detail pupuk: ' . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    public function updateProduk(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'id_produk' => 'required|integer',
                'nama_produk' => 'nullable|string',
                'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Pastikan foto adalah file gambar dengan format yang valid dan ukuran maksimum 2MB
                'harga_produk' => 'nullable|numeric', // Pastikan harga_produk adalah angka
                'deskripsi_produk' => 'nullable|string',
                'stok_produk' => 'nullable|integer', // Pastikan stok_produk adalah bilangan bulat
                'id_user' => 'required|integer', // Pastikan id_user adalah bilangan bulat
            ]);

            // Jika validasi gagal
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
            }

            // Cari produk berdasarkan id
            $produk = Produk::find($request->id_produk);

            // Jika produk tidak ditemukan
            if (!$produk) {
                return response()->json(['status' => 'error', 'message' => 'Produk tidak ditemukan'], 404);
            }

            // Perbarui data produk
            if ($request->has('nama_produk')) {
                $produk->nama_produk = $request->nama_produk;
            }
            if ($request->has('foto_produk')) {
                $foto_produk = $request->file('foto_produk');
                $namaFile = uniqid() . '_' . $foto_produk->getClientOriginalName();
                $foto_produk->move(public_path('Images/Produk'), $namaFile);
                $produk->foto_produk = $namaFile;
            }
            if ($request->has('harga_produk')) {
                $produk->harga_produk = $request->harga_produk;
            }
            if ($request->has('deskripsi_produk')) {
                $produk->deskripsi_produk = $request->deskripsi_produk;
            }
            if ($request->has('stok_produk')) {
                $produk->stok_produk = $request->stok_produk;
            }
            if ($request->has('id_user')) {
                $produk->id_user = $request->id_user;
            }

            // Simpan perubahan
            $produk->save();

            // Beri respons berhasil
            return response()->json(['status' => 'success', 'message' => 'Data produk berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            // Tangkap kesalahan dan kirim pesan kesalahan dalam respons JSON
            $response = [
                'status' => 'error',
                'message' => 'Gagal memperbarui data produk: ' . $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }
    

}
