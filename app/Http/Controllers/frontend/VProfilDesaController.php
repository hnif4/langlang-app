<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilDesa;


class VProfilDesaController extends Controller
{
     // Menampilkan semua profil desa
     public function index()
     {
         $profilDesas = ProfilDesa::orderBy('tipe')->get();
         return view('frontend.profil_desa.index', compact('profilDesas'));
     }
 
     // Menampilkan detail profil desa berdasarkan slug
     public function show($slug)
     {
         $profilDesa = ProfilDesa::where('slug', $slug)->first();  // Mencari profil desa berdasarkan slug
         return view('frontend.profil_desa.show', compact('profilDesa'));
     }
}
