<?php

// File: app/Models/PengajuanKunjungan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use app\Models\PengajuanKunjungan;



class PengajuanKunjungan extends Model
{
    protected $table = 'pengajuan_kunjungan'; // Gantilah 'pengajuan_kunjungan' sesuai dengan nama tabel yang sesuai di database

    protected $fillable = [
        'nama_kunjungan',
        'alamat_kunjungan',
        'nama_instansi_kunjungan',
        'no_hp_kunjungan',
        'tanggal_kunjungan',
        'tujuan_kunjungan',
        'status_kunjungan',
        'alasan_status_kunjungan',
        // Tambahkan atribut lainnya sesuai kebutuhan
    ];

    // Jika Anda tidak menggunakan timestamp (created_at dan updated_at)
    public $timestamps = true;
}
