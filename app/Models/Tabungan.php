<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tabungan'; 
    protected $primaryKey = 'id_tabungan';

    protected $fillable = [
        'tgl_tabungan',
        'ketsampah_tabungan',
        'beratsampah_tabungan',
        'tipe_tabungan',
        'hargasampah_tabungan',
        'saldoakhir_tabungan',
        'id_user',
        

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


}
