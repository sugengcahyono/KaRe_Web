<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'nama_produk',
        'foto_produk',
        'harga_produk',
        'deskripsi_produk',
        'stok_produk',
        'id_user',


    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
