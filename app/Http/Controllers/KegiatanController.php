<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {      
        // dd('test halaman kegiatan');

         $kegiatan = Kegiatan::all();
         return view ('kegiatan', ['kegiatanList' => $kegiatan]);

        //  dd($kegiatan);

        // dd('test halaman kegiatan');
        // $nama_kegiatan = "Bersih Desa";
        
    }

}
