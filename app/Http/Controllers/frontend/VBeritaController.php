<?php
namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class VBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('frontend.berita.index', compact('beritas'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $beritaLainnya = Berita::where('id', '!=', $berita->id)->latest()->take(5)->get();

        return view('frontend.berita.show', compact('berita', 'beritaLainnya'));
    }
}