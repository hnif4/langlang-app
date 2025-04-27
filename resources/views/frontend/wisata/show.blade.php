@extends('layouts.frontend')

@section('content')
<div class="container py-12">
    <h2 class="text-3xl font-semibold mb-6">{{ $wisata->judul }}</h2>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- Gambar -->
        <div class="flex h-full">
            <img src="{{ asset('storage/' . $wisata->gambar) }}"
                alt="{{ $wisata->judul }}"
                class="w-full h-full object-cover rounded shadow">
        </div>

        <!-- Konten Wisata -->
        <div class="flex flex-col justify-between h-full text-gray-700 space-y-4">
            <p>{{ $wisata->deskripsi }}</p>

            <div class="grid md:grid-cols-2 gap-4 mt-6">
                <!-- Harga & Jam -->
                <div class="bg-gray-100 p-4 rounded shadow hover:bg-gray-200 transition cursor-pointer">
                    <p class="text-sm text-gray-500">Harga Tiket</p>
                    <p class="text-lg font-semibold">Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mt-2">Jam Operasional</p>
                    <p class="text-lg font-semibold">{{ $wisata->jam_operasional }}</p>
                </div>

                <!-- Kontak -->
                <div class="bg-gray-100 p-4 rounded shadow flex flex-col gap-2">
                    <p class="text-sm text-gray-500 mb-1">Kontak</p>
                    <a href="https://wa.me/{{ $wisata->kontak }}" target="_blank"
                        class="bg-green-500 text-white py-4 px-2 rounded hover:bg-green-600 text-center">
                        WhatsApp
                    </a>
                </div>
            </div>

            <!-- Lokasi -->
            <div class="mt-6">
                <p class="text-sm text-gray-500 mb-2">Lokasi</p>
                <div class="rounded overflow-hidden shadow">
                    <iframe
                        src="https://www.google.com/maps?q={{ urlencode($wisata->lokasi) }}&output=embed"
                        width="100%"
                        height="300"
                        frameborder="0"
                        style="border:0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekomendasi Wisata -->
    <h3 class="text-xl font-semibold mt-12 mb-4">Rekomendasi Wisata Lain</h3>
    <div class="grid md:grid-cols-3 gap-4">
        @foreach($wisataLainnya as $item)
        <div class="bg-white rounded shadow p-4">
            <img src="{{ asset('storage/' . $item->gambar) }}"
                class="h-32 w-full object-cover rounded mb-2">
            <h4 class="font-medium text-gray-800">{{ $item->judul }}</h4>
            <!-- Ganti $wisata->slug dengan $item->slug untuk mengarahkan ke wisata yang dipilih -->
            <a href="{{ route('frontend.wisata.show', $item->slug) }}" class="mt-3 inline-block text-yellow-500 hover:underline text-sm font-medium">Selengkapnya →</a>
        </div>
        @endforeach
    </div>


    <!-- Back Link -->
    <a href="{{ route('frontend.wisata.index') }}"
        class="inline-block mt-8 text-emerald-600 hover:underline transition">
        ← Kembali ke daftar wisata
    </a>
</div>
@endsection