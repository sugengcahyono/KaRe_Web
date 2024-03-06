<?php

// File: app/Models/FormulirKunjungan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditFormulir extends Model
{
    protected $table = 'pengajuan_kunjungan'; 
    protected $fillable = [
        'nama_kunjungan',
        'alamat_kunjungan',
        'nama_instansi_kunjungan',
        'no_hp_kunjungan',
        'tanggal_kunjungan',
        'tujuan_kunjungan',
        'status_kunjungan',
        'alasan_status_kunjungan',
    ];

    public $timestamps = true;
}
