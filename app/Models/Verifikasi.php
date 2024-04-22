<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'verification'; 
    protected $primaryKey = 'id_verification';

    protected $fillable = [
        'email_verification',
        'otp_verification',
        'type_verification',
        'start_millis',
        'end_millis',
        'device',
        'resend',

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
