<?php

// File: app/Models/FormulirKunjungan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormulirKunjungan extends Model
{
    public $timestamps = true;
    protected $table = 'kunjungan';
    protected $primaryKey = 'id_kunjungan';

    protected $fillable = [
        'nama_kunjungan',
        'alamat_kunjungan',
        'namainstansi_kunjungan',
        'nohp_kunjungan',
        'tanggal_kunjungan',
        'tujuan_kunjungan',
        'status_kunjungan',
        'jumlah_kunjungan',
        'alasanstatus_kunjungan',

    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
