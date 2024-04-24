<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'foto_kegiatan',
        'deskripsi_kegiatan',
        'id_user',
        

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


}
