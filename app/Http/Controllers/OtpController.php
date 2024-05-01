<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $email = $request->input('email');
        // Generate OTP
        $otp = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        // Kirim OTP melalui email
        Mail::to($email)->send(new OtpMail($otp));

        return response()->json(['message' => 'otp terkirim', 'otp'=>$otp], 200);
    }
}
