<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;
    protected $table = 'tabungan'; 
    protected $fillable = [
        'id_tabungan',
        'tanggal_tabungan',
        'keterangansampah_tabungan',
        'beratsampah_tabungan',
        'tipe_tabungan',
        'hargasampah_tabungan',
        'saldoakhir_tabungan',
        

    ];

    public $timestamps = true;

}
