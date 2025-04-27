@extends('layouts.frontend')

@section('content')
<div class="container py-12 max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Hasil Pencarian: "{{ $query }}"</h1>

    @if ($beritas->isNotEmpty() || $wisatas->isNotEmpty() || $umkms->isNotEmpty() || $profilDesas->isNotEmpty())
    <div class="space-y-8">

        {{-- Berita --}}
        @if ($beritas->isNotEmpty())
        <div>
            <h2 class="text-2xl font-semibold">Berita</h2>
            @foreach($beritas as $berita)
            <div class="border-b pb-4">
                <a href="{{ route('berita.show', $berita->slug) }}" class="text-lg font-medium text-gray-800 hover:text-blue-500">
                    {{ $berita->judul }}
                </a>
                <p class="text-sm text-gray-500 mt-2">{{ Str::limit($berita->konten, 100) }}...</p>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Wisata --}}
        @if ($wisatas->isNotEmpty())
        <div>
            <h2 class="text-2xl font-semibold mt-8">Wisata</h2>
            @foreach($wisatas as $wisata)
            <div class="border-b pb-4">
                <a href="{{ route('frontend.wisata.show', $wisata->slug) }}" class="text-lg font-medium text-gray-800 hover:text-blue-500">
                    {{ $wisata->judul }}
                </a>
                <p class="text-sm text-gray-500 mt-2">Lokasi: {{ $wisata->lokasi }}</p>
                <p class="text-sm text-gray-500">Harga Tiket: Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</p>
            </div>
            @endforeach
        </div>
        @endif

        {{-- UMKM --}}
        @if ($umkms->isNotEmpty())
        <div>
            <h2 class="text-2xl font-semibold mt-8">UMKM</h2>
            @foreach($umkms as $umkm)
            <div class="border-b pb-4">
                <a href="{{ route('frontend.umkm.show', $umkm->slug) }}" class="text-lg font-medium text-gray-800 hover:text-blue-500">
                    {{ $umkm->judul }}
                </a>
                <p class="text-sm text-gray-500 mt-2">Kontak: {{ $umkm->kontak }}</p>
                <p class="text-sm text-gray-500">Harga: Rp {{ number_format($umkm->harga, 0, ',', '.') }}</p>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Profil Desa --}}
        @if ($profilDesas->isNotEmpty())
        <h2 class="text-2xl font-semibold mt-8">Tentang Desa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-data="{ modalOpen: false, selectedProfil: null }">
            @foreach($profilDesas as $profil)
            <div class="border-b pb-4">
                <h3 class="text-lg font-medium text-gray-800">{{ $profil->judul }}</h3>
                <p class="text-sm text-gray-500 mt-2">{{ Str::limit($profil->konten, 100) }}</p>
                <button
                    class="mt-2 text-emerald-600 hover:underline text-sm"
                    @click="selectedProfil = {{ $profil->toJson() }}; modalOpen = true">
                    Lihat Detail
                </button>
            </div>
            @endforeach

            <!-- Modal -->
            <div
                class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center px-4"
                x-show="modalOpen"
                x-transition
                x-cloak>
                <div
                    class="bg-white rounded-lg w-full max-w-2xl max-h-[80vh] overflow-y-auto p-6 relative shadow-xl"
                    @click.away="modalOpen = false">
                    <template x-if="selectedProfil">
                        <div>
                            <h3 class="text-2xl font-bold mb-4" x-text="selectedProfil.judul"></h3>
                            <p class="text-gray-700 text-sm whitespace-pre-line" x-text="selectedProfil.konten"></p>
                        </div>
                    </template>

                    <button
                        @click="modalOpen = false"
                        class="absolute top-2 right-2 text-black p-2 transition">
                        &times;
                    </button>
                </div>
            </div>
        </div>

        @endif

    </div>
    @else
    <p class="text-gray-500">Tidak ada hasil yang ditemukan untuk pencarian "{{ $query }}"</p>
    @endif
</div>
@endsection