@extends('layouts.frontend')

@section('content')
<div class="container py-12" x-data="{ modalOpen: false, selectedProfil: null }">
    <h2 class="text-3xl font-semibold text-center text-emerald-600 mb-4 animate-fade-in">
        Tentang Desa
    </h2>
    <p class="text-gray-600 text-center mb-12 animate-fade-in delay-200">
        Lestarikan Desa Kita dengan mengenal Budaya
    </p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($profilDesas as $index => $profil)
        <div
            class="card bg-white shadow-lg rounded-lg overflow-hidden transform transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl opacity-0 animate-fade-in-up delay-[{{ $index * 100 }}ms]">
            <div class="p-4">
                <span class="inline-block px-2 py-1 text-xs bg-emerald-100 text-emerald-600 rounded-full mb-2">
                    {{ $profil->tipe }}
                </span>
                <h3 class="text-xl font-medium text-gray-800">{{ $profil->judul }}</h3>
                <p class="text-sm text-gray-600 mt-2">{{ Str::limit($profil->konten, 200) }}</p>
                <button
                    class="mt-4 inline-block text-emerald-600 hover:underline transition duration-300"
                    @click="selectedProfil = {{ $profil->toJson() }}; modalOpen = true">
                    Lihat Detail
                </button>
            </div>
        </div>
        @endforeach
    </div>

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

            <!-- Tombol Tutup di pojok kanan atas -->
            <button
                @click="modalOpen = false"
                class="absolute top-2 right-2  text-black p-2  transition">
                &times;
            </button>
        </div>
    </div>
</div>
@endsection