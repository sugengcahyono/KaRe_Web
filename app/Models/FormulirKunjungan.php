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
        'nama_instansi_kunjungan',
        'no_hp_kunjungan',
        'tanggal_kunjungan',
        'tujuan_kunjungan',
        'status_kunjungan',
        'jumlah_kunjungan',
        'alasan_status_kunjungan',

    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}