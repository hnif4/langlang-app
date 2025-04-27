@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 px-4">
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-xl font-bold text-gray-700">Profil Desa</h3>
                <p class="text-3xl text-purple-600 mt-2">{{ $jumlahProfil }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-xl font-bold text-gray-700">Berita</h3>
                <p class="text-3xl text-green-600 mt-2">{{ $jumlahBerita }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-xl font-bold text-gray-700">UMKM</h3>
                <p class="text-3xl text-pink-600 mt-2">{{ $jumlahUmkm }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-xl font-bold text-gray-700">Wisata</h3>
                <p class="text-3xl text-blue-600 mt-2">{{ $jumlahWisata }}</p>
            </div>
        </div>
    </div>

    {{-- Berita Terbaru --}}
    <div class="mt-10 px-4 max-w-7xl mx-auto">
        <h3 class="text-2xl font-bold mb-4 text-gray-700">📰 Berita Terbaru</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($beritaTerbaru as $berita)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-semibold text-gray-800">{{ $berita->judul }}</h4>
                        <p class="text-sm text-gray-500 mt-1">{{ $berita->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">Belum ada berita terbaru.</div>
            @endforelse
        </div>
        {{-- Tombol Lihat Semua --}}
        <div class="text-right mt-4">
            <a href="{{ route('admin.berita.index') }}" class="text-blue-600 hover:underline text-sm">Lihat semua berita →</a>
        </div>
    </div>

    {{-- UMKM Terbaru --}}
    <div class="mt-10 px-4 max-w-7xl mx-auto">
        <h3 class="text-2xl font-bold mb-4 text-gray-700">🏪 UMKM Terbaru</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($umkmTerbaru as $umkm)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $umkm->gambar) }}" alt="{{ $umkm->nama }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-semibold text-gray-800">{{ $umkm->judul }}</h4>
                        <p class="text-sm text-gray-500 mt-1">Rp {{ number_format($umkm->harga, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $umkm->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">Belum ada data UMKM terbaru.</div>
            @endforelse
        </div>
        {{-- Tombol Lihat Semua --}}
        <div class="text-right mt-4">
            <a href="{{ route('admin.umkm.index') }}" class="text-blue-600 hover:underline text-sm">Lihat semua UMKM →</a>
        </div>
    </div>
    {{-- Wisata Terbaru --}}
    <div class="mt-10 px-4 max-w-7xl mx-auto">
        <h3 class="text-2xl font-bold mb-4 text-gray-700"> Wisata Terbaru</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($WisataTerbaru as $wisata)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $wisata->gambar) }}" alt="{{ $wisata->nama }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-semibold text-gray-800">{{ $wisata->judul }}</h4>
                        <p class="text-sm text-gray-500 mt-1">Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $wisata->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">Belum ada data Wisata terbaru.</div>
            @endforelse
        </div>
        {{-- Tombol Lihat Semua --}}
        <div class="text-right mt-4">
            <a href="{{ route('admin.wisata.index') }}" class="text-blue-600 hover:underline text-sm">Lihat semua Wisata →</a>
        </div>
    </div>
@endsection
