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

        // Ambil data tabungan berdasarkan id_user
        $tabungan = Tabungan::where('id_user', $userId)->get();

        if ($tabungan->isEmpty()) {
            return response()->json(['message' => 'Data tabungan tidak ditemukan'], 404);
        }

        return response()->json(['data' => $tabungan], 200);
    }

}