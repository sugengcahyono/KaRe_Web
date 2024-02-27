<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use views\frontend\kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {      
        // dd('test halaman kegiatan');

        //  $kegiatan = Kegiatan::all();
         return view ('frontend.kegiatan');

        //  dd($kegiatan);

        // dd('test halaman kegiatan');
        // $nama_kegiatan = "Bersih Desa";
        
    }

}
