<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $email = $request->input('email_user');
        // Generate OTP
        $otp = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Kirim OTP melalui email
        Mail::to($email)->send(new OtpMail($otp));

        return response()->json(['message' => 'otp terkirim', 'otp'=>$otp], 200);
    }


    public function checkEmail(Request $request)
{
    $email = $request->input('email_user');
    
    // Cek apakah email terdaftar dan memiliki level admin
    $user = User::where('email_user', $email)->where('level_user', 'admin')->first();
    
    if ($user) {
        // Generate OTP
        $otp = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // Kirim OTP melalui email
        Mail::to($email)->send(new OtpMail($otp));
        
        return response()->json(['message' => 'otp terkirim', 'otp'=>$otp], 200);
    } else {
        return response()->json(['message' => 'Email tidak terdaftar atau bukan admin'], 400);
    }
}

public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'new_password' => 'required|min:6',
    ]);

    $user = User::where('email_user', $request->email)->first();

    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
    }

    $user->password_user = Hash::make($request->new_password);
    $user->save();

    return response()->json(['success' => true, 'message' => 'Password berhasil diubah']);
}





    // public function sendOtp(Request $request)
    // {
    //     $email = $request->input('email');
    //     // Generate OTP
    //     $otp = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

    //     // Kirim OTP melalui email
    //     Mail::to($email)->send(new OtpMail($otp));

    //     return response()->json(['message' => 'otp terkirim', 'otp'=>$otp], 200);
    // }


//     public function sendOtp(Request $request)
// {
//     $email = $request->input('email');
//     // Cek apakah email tersedia di database
//     $user = User::where('email', $email)->first();

//     if (!$user) {
//         return response()->json(['message' => 'Email tidak ditemukan'], 404);
//     }

//     // Generate OTP
//     $otp = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

//     // Simpan OTP di database atau sesuai kebutuhan
//     $user->otp = $otp;
//     $user->save();

//     // Kirim OTP melalui email
//     Mail::to($email)->send(new OtpMail($otp));

//     return response()->json(['message' => 'OTP terkirim'], 200);
// }

// public function verifyOtp(Request $request)
// {
//     $otp = $request->input('otp');
//     $user = Auth::user(); // Menggunakan authentikasi Laravel, pastikan Anda telah mengautentikasi pengguna sebelumnya

//     // Periksa apakah OTP yang dimasukkan oleh pengguna sesuai dengan OTP yang dikirimkan
//     if ($user->otp === $otp) {
//         // OTP benar, arahkan pengguna ke halaman ganti password atau lakukan tindakan yang sesuai
//         return response()->json(['message' => 'OTP benar'], 200);
//     } else {
//         // OTP salah
//         return response()->json(['message' => 'OTP salah'], 400);
//     }
// }


}
