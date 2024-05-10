<?php

namespace App\Http\Controllers\MobileApi;

use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MobileTabunganController extends Controller
{

    public function beratSampahPerHari()
{
    $beratSampahPerHari = Tabungan::whereDate('tgl_tabungan', today())->sum('beratsampah_tabungan');
    $beratSampahPerHari = round($beratSampahPerHari, 2);
    return response()->json(['berat_sampah_per_hari' => $beratSampahPerHari]);
}

public function beratSampahPerBulan()
{
    $beratSampahPerBulan = Tabungan::whereMonth('tgl_tabungan', now()->month)->sum('beratsampah_tabungan');
    $beratSampahPerBulan = round($beratSampahPerBulan, 2);
    return response()->json(['berat_sampah_per_bulan' => $beratSampahPerBulan]);
}

public function beratSampahPerTahun()
{
    $beratSampahPerTahun = Tabungan::whereYear('tgl_tabungan', now()->year)->sum('beratsampah_tabungan');
    $beratSampahPerTahun = round($beratSampahPerTahun, 2);
    return response()->json(['berat_sampah_per_tahun' => $beratSampahPerTahun]);
}



    public function getDataTabungan(Request $request)
{
    $userId = $request->input('id_user');

    // Validasi input
    $validator = validator()->make($request->all(), [
        'id_user' => 'required|exists:user,id_user',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    // Ambil bulan dan tahun saat ini
    $currentMonth = date('m');
    $currentYear = date('Y');

    // Ambil data tabungan berdasarkan id_user dan bulan ini
    $tabungan = Tabungan::where('id_user', $userId)
        ->whereMonth('tgl_tabungan', $currentMonth)
        ->whereYear('tgl_tabungan', $currentYear)
        ->get();

    if ($tabungan->isEmpty()) {
        return response()->json(['message' => 'Data tabungan untuk bulan ini tidak ditemukan'], 404);
    }

    return response()->json(['data' => $tabungan], 200);
}

    // public function getDataTabungan(Request $request)
    // {
    //     $userId = $request->input('id_user');

    //     // Validasi input
    //     $validator = validator()->make($request->all(), [
    //         'id_user' => 'required|exists:user,id_user',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }

    //     // Ambil data tabungan berdasarkan id_user
    //     $tabungan = Tabungan::where('id_user', $userId)->get();

    //     if ($tabungan->isEmpty()) {
    //         return response()->json(['message' => 'Data tabungan tidak ditemukan'], 404);
    //     }

    //     return response()->json(['data' => $tabungan], 200);
    // }


public function tambahTabungan(Request $request)
{
    $iduser = $request->input('id_user');

    // Validasi input
    $validator = Validator::make($request->all(), [
        'tgl_tabungan' => 'required|date',
        'ketsampah_tabungan' => 'required',
        'beratsampah_tabungan' => 'required|numeric',
        'tipe_tabungan' => 'required|in:masuk,keluar',
        'hargasampah_tabungan' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    try {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($iduser);

        // Dapatkan saldo tabungan terakhir pengguna
        $saldoSebelumnya = $user->tabungan()->latest()->value('saldoakhir_tabungan') ?? 0;

        // Hitung saldo akhir berdasarkan tipe tabungan
        if ($request->tipe_tabungan === 'masuk') {
            $saldoAkhir = $saldoSebelumnya + $request->hargasampah_tabungan;
        } elseif ($request->tipe_tabungan === 'keluar') {
            $saldoAkhir = $saldoSebelumnya - $request->hargasampah_tabungan;

            // Pastikan saldo akhir tidak negatif
            if ($saldoAkhir < 0) {
                return response()->json(['error' => 'Saldo tidak mencukupi untuk transaksi ini'], 400);
            }
        }

        // Buat entri tabungan baru
        $tabungan = new Tabungan();
        $tabungan->tgl_tabungan = $request->tgl_tabungan;
        $tabungan->ketsampah_tabungan = $request->ketsampah_tabungan;
        $tabungan->beratsampah_tabungan = $request->beratsampah_tabungan;
        $tabungan->tipe_tabungan = $request->tipe_tabungan;
        $tabungan->hargasampah_tabungan = $request->hargasampah_tabungan;
        $tabungan->saldoakhir_tabungan = $saldoAkhir;

        // Simpan tabungan
        $user->tabungan()->save($tabungan);

        // Berhasil, kembalikan respons
        return response()->json(['message' => 'Tabungan berhasil ditambahkan', 'saldo_akhir' => $saldoAkhir], 200);
    } catch (\Exception $e) {
        // Tangani kesalahan
        return response()->json(['error' => 'Gagal menambahkan tabungan: ' . $e->getMessage()], 500);
    }
}


//     public function tambahTabungan(Request $request)
// {
//     $iduser = $request->input('id_user');

//     // Validasi input
//     $validator = Validator::make($request->all(), [
//         'tgl_tabungan' => 'required|date',
//         'ketsampah_tabungan' => 'required',
//         'beratsampah_tabungan' => 'required|numeric',
//         'tipe_tabungan' => 'required|in:masuk,keluar',
//         'hargasampah_tabungan' => 'required|numeric',
//     ]);

//     if ($validator->fails()) {
//         return response()->json(['error' => $validator->errors()], 400);
//     }

//     try {
//         // Temukan pengguna berdasarkan ID
//         $user = User::findOrFail($iduser);

//         // Dapatkan saldo tabungan terakhir pengguna
//         $saldoSebelumnya = $user->tabungan()->latest()->value('saldoakhir_tabungan') ?? 0;

//         // Hitung saldo akhir berdasarkan tipe tabungan
//         if ($request->tipe_tabungan === 'masuk') {
//             $saldoAkhir = $saldoSebelumnya + $request->hargasampah_tabungan;
//         } elseif ($request->tipe_tabungan === 'keluar') {
//             $saldoAkhir = $saldoSebelumnya - $request->hargasampah_tabungan;
//         }

//         // Buat entri tabungan baru
//         $tabungan = new Tabungan();
//         $tabungan->tgl_tabungan = $request->tgl_tabungan;
//         $tabungan->ketsampah_tabungan = $request->ketsampah_tabungan;
//         $tabungan->beratsampah_tabungan = $request->beratsampah_tabungan;
//         $tabungan->tipe_tabungan = $request->tipe_tabungan;
//         $tabungan->hargasampah_tabungan = $request->hargasampah_tabungan;
//         $tabungan->saldoakhir_tabungan = $saldoAkhir;

//         // Simpan tabungan
//         $user->tabungan()->save($tabungan);

//         // Berhasil, kembalikan respons
//         return response()->json(['message' => 'Tabungan berhasil ditambahkan', 'saldo_akhir' => $saldoAkhir], 200);
//     } catch (\Exception $e) {
//         // Tangani kesalahan
//         return response()->json(['error' => 'Gagal menambahkan tabungan: ' . $e->getMessage()], 500);
//     }
// }

public function getRiwayatTabungan(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|integer',
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer|min:2000|max:9999',
        ]);

        // Jika input tidak valid, kembalikan response dengan status 400
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Ambil data dari input
        $id_user = $request->input('id_user');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Query untuk mengambil data tabungan berdasarkan id_user, bulan, dan tahun
        $tabungan = Tabungan::where('id_user', $id_user)
            ->whereMonth('tgl_tabungan', $bulan)
            ->whereYear('tgl_tabungan', $tahun)
            ->get();

        // Jika data ditemukan, kembalikan response dengan status 200 dan data tabungan
        if ($tabungan->isNotEmpty()) {
            return response()->json(['tabungan' => $tabungan], 200);
        } else {
            // Jika tidak ada data, kembalikan response dengan status 404
            return response()->json(['message' => 'Tabungan not found'], 404);
        }
    }




}



    

