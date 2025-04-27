<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\ProfilDesa;
use App\Models\Wisata;
use App\Models\UMKM;
use App\Models\Berita;


class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $profilDesaUtama = ProfilDesa::where('tipe', 'sejarah')->first();
        $wisatas = Wisata::latest()->get();
        $umkms = UMKM::latest()->get();
        $beritas = Berita::latest()->get();
    
        return view('frontend.home', compact('sliders','profilDesaUtama','wisatas','umkms','beritas'));
    }
}
