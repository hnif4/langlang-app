<?php

// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use App\Models\Berita;
use App\Models\UMKM;
use App\Models\Wisata;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahProfil = ProfilDesa::count();
        $jumlahBerita = Berita::count();
        $jumlahUmkm = UMKM::count();
        $jumlahWisata = Wisata::count();
        $beritaTerbaru = Berita::latest()->take(3)->get();
        $umkmTerbaru = UMKM::latest()->take(3)->get();
        $WisataTerbaru = Wisata::latest()->take(3)->get();


        return view('admin.dashboard', compact(
            'jumlahProfil',
            'jumlahBerita',
            'jumlahUmkm',
            'jumlahWisata',
            'beritaTerbaru',
            'umkmTerbaru',
            'WisataTerbaru'
        ));
    }
}

