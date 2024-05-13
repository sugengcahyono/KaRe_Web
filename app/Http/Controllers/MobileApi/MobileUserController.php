<?php

namespace App\Http\Controllers\MobileApi;

use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MobileUserController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email_user' => 'required|email',
            'password_user' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        // Ambil data dari form login
        $email = $request->input('email_user');
        $password = $request->input('password_user');

        // Mengambil data pengguna berdasarkan email dari tabel 'user'
        $user = User::where('email_user', $email)->first();

        if ($user) {
            // Verifikasi password
            if (Hash::check($password, $user->password_user)) {
                // Pastikan pengguna adalah admin
                if ($user->level_user == "admin") {
                    // Buat respons JSON dengan data pengguna
                    $response = [
                        "status" => "success",
                        "data" => [
                            "id_user" => $user->id_user,
                            "email_user" => $user->email_user,
                            "nama_user" => $user->nama_user,
                            "alamat_user" => $user->alamat_user,
                            "notelp_user" => $user->notelp_user,
                            "foto_user" => $user->foto_user,
                            "level_user" => $user->level_user
                        ]
                    ];
                } else {
                    $response = ["status" => "error", "message" => "Anda tidak memiliki akses sebagai admin"];
                }
            } else {
                $response = ["status" => "error", "message" => "Password salah"];
            }
        } else {
            $response = ["status" => "error", "message" => "Email tidak ditemukan"];
        }

        // Tampilkan respons JSON
        return response()->json($response);
    }

//MENAMBAHKAN ANGGOTA
    public function addUser(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email_user' => 'required|email|unique:user,email_user',
            'password_user' => 'required',
            'nama_user' => 'required',
            'alamat_user' => 'required',
            'notelp_user' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        // Ambil data dari form
        $email = $request->input('email_user');
        $password = Hash::make($request->input('password_user'));
        $nama_user = $request->input('nama_user');
        $alamat_user = $request->input('alamat_user');
        $notelp_user = $request->input('notelp_user');
        $foto_user = $request->input('foto_user') ?? 'default.jpg'; // Memberikan nilai default 'default.jpg' jika foto_user tidak disediakan

        
        // Set level user sebagai user
        $level_user = "user";

        // Buat user baru di tabel 'user'
        $user = new User();
        $user->email_user = $email;
        $user->password_user = $password;
        $user->nama_user = $nama_user;
        $user->alamat_user = $alamat_user;
        $user->notelp_user = $notelp_user;
        $user->foto_user = $foto_user;
        $user->level_user = $level_user;

        // Simpan user
        if ($user->save()) {
            // Buat respons JSON
            $response = ['status' => 'success', 'message' => 'Anggota berhasil ditambahkan'];
        } else {
            // Buat respons JSON
            $response = ['status' => 'error', 'message' => 'Gagal menambahkan Anggota'];
        }

        // Tampilkan respons JSON
        return response()->json($response);
    }

//MENAMBAHKAN ADMIN
    public function addAdmin(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email_user' => 'required|email',
            'password_user' => 'required',
            'nama_user' => 'required',
            'alamat_user' => 'required',
            'notelp_user' => 'required',
            'foto_user' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Pastikan foto adalah file gambar dengan format yang valid dan ukuran maksimum 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        // Ambil data dari form
        $email = $request->input('email_user');
        $password = Hash::make($request->input('password_user'));
        $nama_user = $request->input('nama_user');
        $alamat_user = $request->input('alamat_user');
        $notelp_user = $request->input('notelp_user');
        $foto_user = $request->file('foto_user');

        // Simpan foto user di KaRe_Web\public\Images\Foto dengan nama yang unik
        $nama_file = uniqid() . '_' . $foto_user->getClientOriginalName();
        $foto_user->move(public_path('Images/Foto'), $nama_file);

        // Set level user sebagai admin
        $level_user = "admin";

        // Buat user baru di tabel 'user'
        $user = new User();
        $user->email_user = $email;
        $user->password_user = $password;
        $user->nama_user = $nama_user;
        $user->alamat_user = $alamat_user;
        $user->notelp_user = $notelp_user;
        $user->foto_user = $nama_file; // Simpan hanya nama file di database
        $user->level_user = $level_user;

        // Simpan user
        if ($user->save()) {
            // Buat respons JSON
            $response = ['status' => 'success', 'message' => 'Admin berhasil ditambahkan', 'foto_user' => $nama_file];
        } else {
            // Buat respons JSON
            $response = ['status' => 'error', 'message' => 'Gagal menambahkan Admin'];
        }

        // Tampilkan respons JSON
        return response()->json($response);
    }

    public function uploadKegiatan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => 'required',
            'deskripsi_kegiatan' => 'required',
            'foto_kegiatan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Pastikan foto adalah file gambar dengan format yang valid dan ukuran maksimum 2MB
            'id_user' => 'required|integer', // Pastikan id_user adalah bilangan bulat
        ]);

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

        // Sekarang Anda dapat menyimpan $namaFile di dalam database atau melakukan operasi lain yang diperlukan

        // Buat respons JSON
        $response = ['status' => 'success', 'message' => 'Kegiatan berhasil diunggah', 'nama_file' => $namaFile];

        // Tampilkan respons JSON
        return response()->json($response);
    }


    public function get_DataAdmin()
    {
        try {
            // Ambil data admin dengan kriteria level_user 'admin'
            $admins = User::where('level_user', 'admin')->get(['nama_user', 'email_user']);

            // Buat respons JSON
            $response = ['status' => 'success', 'admins' => $admins];

            return response()->json($response);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            $response = ['status' => 'error', 'message' => $e->getMessage()];

            return response()->json($response, 500);
        }
    }

    public function get_DataUser()
{
    try {
        // Ambil data pengguna dengan kriteria level_user 'user'
        $users = User::where('level_user', 'user')->get(['id_user', 'nama_user', 'email_user', 'alamat_user']);

        // Buat respons JSON
        $response = ['status' => 'success', 'users' => $users];

        return response()->json($response);
    } catch (\Exception $e) {
        // Jika terjadi kesalahan
        $response = ['status' => 'error', 'message' => $e->getMessage()];

        return response()->json($response, 500);
    }
}





    public function get_AnggotaTabungan()
{
    try {
        // Ambil semua data anggota tabungan tanpa kriteria
        $users = User::orderBy('nama_user')->get();

        // Buat respons JSON
        $response = ['status' => 'success', 'users' => $users];

        return response()->json($response);
    } catch (\Exception $e) {
        // Jika terjadi kesalahan
        $response = ['status' => 'error', 'message' => $e->getMessage()];

        return response()->json($response, 500);
    }
}



    public function getUserDetail(Request $request)
{
    try {
        // Periksa apakah request memiliki id_user
        if ($request->has('id_user')) {
            // Dapatkan id_user dari request
            $id_user = $request->id_user;

            // Cari pengguna berdasarkan id_user
            $user = User::find($id_user);

            // Jika pengguna ditemukan
            if ($user) {
                // Buat respons JSON dengan detail pengguna
                $response = [
                    'status' => 'success',
                    'data' => $user
                ];
            } else {
                // Jika pengguna tidak ditemukan, kirim pesan kegagalan dalam respons JSON
                $response = [
                    'status' => 'error',
                    'message' => 'Pengguna tidak ditemukan'
                ];
            }
        } else {
            // Jika request tidak memiliki id_user, kirim pesan kegagalan dalam respons JSON
            $response = [
                'status' => 'error',
                'message' => 'ID Pengguna tidak diberikan'
            ];
        }

        // Kembalikan respons JSON
        return response()->json($response);
    } catch (\Exception $e) {
        // Tangkap kesalahan dan kirim pesan kesalahan dalam respons JSON
        $response = [
            'status' => 'error',
            'message' => 'Gagal mendapatkan detail pengguna: ' . $e->getMessage()
        ];
        return response()->json($response, 500);
    }
}


public function updatePhoto(Request $request)
{
    // Validasi request
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->file('photo')->isValid()) {
        $uploadedPhotoPath = $request->file('photo')->store('photos', 'public');
        // Simpan path foto di database atau storage sesuai kebutuhan aplikasi
        return response()->json(['message' => 'Photo uploaded successfully', 'path' => $uploadedPhotoPath]);
    }

    return response()->json(['message' => 'Invalid photo'], 400);
}

public function updateUser(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|integer',
            'nama_user' => 'nullable|string',
            'email_user' => 'nullable|email',
            'notelp_user' => 'nullable|string',
            'alamat_user' => 'nullable|string',
            'foto_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Pastikan foto adalah file gambar dengan format yang valid dan ukuran maksimum 10MB
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        // Cari pengguna berdasarkan id
        $user = User::find($request->id_user);

        // Jika pengguna tidak ditemukan
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Pengguna tidak ditemukan'], 404);
        }

        // Perbarui data pengguna
        if ($request->has('nama_user')) {
            $user->nama_user = $request->nama_user;
        }
        if ($request->has('email_user')) {
            $user->email_user = $request->email_user;
        }
        if ($request->has('notelp_user')) {
            $user->notelp_user = $request->notelp_user;
        }
        if ($request->has('alamat_user')) {
            $user->alamat_user = $request->alamat_user;
        }
        if ($request->hasFile('foto_user')) {
            $foto_user = $request->file('foto_user');
            $namaFile = uniqid() . '_' . $foto_user->getClientOriginalName();
            $foto_user->move(public_path('Images/Foto'), $namaFile);
            $user->foto_user = $namaFile;
        }

        // Simpan perubahan
        $user->save();

        // Beri respons berhasil
        return response()->json(['status' => 'success', 'message' => 'Data pengguna berhasil diperbarui'], 200);
    }


    public function changePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id_user' => 'required|exists:user,id_user',
        'old_password' => 'required',
        'new_password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
    }

    $user = User::find($request->id_user);

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not found']);
    }

    if (!Hash::check($request->old_password, $user->password_user)) {
        return response()->json(['success' => false, 'message' => 'Password lama salah']);
    }

    $user->password_user = bcrypt($request->new_password);
    $user->save();

    return response()->json(['success' => true, 'message' => 'Password berhasil diubah']);
}

public function deleteAccount(Request $request)
{
    // Validasi request
    $validator = Validator::make($request->all(), [
        'id_user' => 'required|exists:user,id_user',
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid input data',
            'errors' => $validator->errors()
        ], 400);
    }

    // Ambil id_user dari request
    $id_user = $request->input('id_user');

    try {
        // Hapus pengguna berdasarkan id_user
        $deleted = User::where('id_user', $id_user)->delete();

        // Jika berhasil dihapus
        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'User berhasil dihapus.'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus user.'
            ], 500);
        }
    } catch (\Exception $e) {
        // Jika terjadi kesalahan
        return response()->json([
            'status' => 'error',
            'message' => 'Gagal menghapus user: ' . $e->getMessage()
        ], 500);
    }
}






}


