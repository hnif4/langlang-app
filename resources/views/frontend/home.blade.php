@extends('layouts.frontend')

@section('content')
<section id="header" class="relative w-full pt-16">
    <div class="relative w-full overflow-hidden">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper flex">
                @foreach($sliders as $slider)
                <div class="swiper-slide relative flex-shrink-0 w-full h-screen"> <!-- Fullscreen untuk gambar -->
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-start justify-end p-10 text-white text-left">
                        <h1 class="text-4xl md:text-5xl font-bold leading-tight">Selamat datang di Desa Wisata!</h1>
                        <p class="text-xl mt-4 opacity-90">Temukan keindahan alam dan budaya lokal yang luar biasa.</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Tombol Navigasi Panah di Pojok Kanan Bawah -->
            <div class="absolute bottom-10 right-10 flex space-x-5 z-10">
                <!-- Tombol Panah Kiri -->
                <div class="swiper-button-prev text-white p-2 md:p-3 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:w-8 md:h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </div>

                <!-- Tombol Panah Kanan -->
                <div class="swiper-button-next text-white p-2 md:p-3 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:w-8 md:h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Profil Desa -->
<section id="tentang" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Gambar -->
        <div>
            <img src="{{ asset('images/profil-desa1.jpg') }}" alt="Sejarah Desa" class="rounded-lg shadow-lg w-full">
        </div>

        <!-- Konten -->
        <div>
            <h2 class="text-3xl font-bold mb-4 text-emerald-600">{{ $profilDesaUtama->judul }}</h2>
            <p class="text-gray-700 mb-6 leading-relaxed">
                {{ \Illuminate\Support\Str::limit(strip_tags($profilDesaUtama->konten ), 500) }}
            </p>
            <a href="{{ url('/profil-desa') }}" class="inline-block bg-emerald-600 hover:bg-yellow-500 text-white py-2 px-5 rounded-lg transition">
                Lihat lebih lanjut
            </a>
        </div>
    </div>
</section>

<!-- Section Wisata -->
<section id="wisata" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-emerald-600 mb-4">Wisata Populer</h2>
        <p class="text-gray-600 text-center mb-12">Temukan destinasi wisata terbaik di desa kami!</p>

        <!-- Scrollable Cards -->
        <div class="flex space-x-6 overflow-x-auto snap-x snap-mandatory pb-4 scrollbar-hide">
            @foreach ($wisatas->take(6) as $wisata)
            <div class="min-w-[300px] max-w-[300px] flex-shrink-0 snap-center bg-white rounded-2xl shadow-md overflow-hidden">
                <!-- Gambar dengan tirai -->
                <div class="relative">
                    <img src="{{ asset('storage/' . $wisata->gambar) }}" alt="{{ $wisata->judul }}" class="w-full h-40 object-cover">
                    <!-- Tirai overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 hover:opacity-75 transition-opacity duration-300"></div>
                </div>

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $wisata->judul }}</h3>
                    <p class="text-sm text-gray-500 mt-1 truncate"><i class="fas fa-map-marker-alt mr-1"></i>{{ $wisata->lokasi }}</p>
                    <p class="text-gray-600 text-sm mt-2 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($wisata->deskripsi), 100) }}</p>
                    <a href="{{ url('/wisata/' . $wisata->slug) }}" class="mt-3 inline-block text-yellow-500 hover:underline text-sm font-medium">Selengkapnya →</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ url('/wisata') }}" class="inline-block bg-emerald-600 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-lg transition">Lihat Semua Wisata</a>
        </div>
    </div>
</section>

<!-- Section UMKM Desa -->
<section id="umkm" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-emerald-600 mb-4">UMKM Desa</h2>
        <p class="text-gray-600 text-center mb-12">Dukung usaha kecil dan menengah di desa kami!</p>

        <!-- Scrollable UMKM Cards -->
        <div class="flex space-x-6 overflow-x-auto snap-x snap-mandatory pb-4 scrollbar-hide">
            @foreach ($umkms->take(5) as $umkm)
            <div class="relative min-w-[270px] max-w-[270px] h-72 flex-shrink-0 snap-center rounded-xl overflow-hidden shadow-lg transform transition duration-500 hover:scale-105">
                <img src="{{ asset('storage/' . $umkm->gambar) }}" alt="{{ $umkm->judul }}" class="w-full h-full object-cover">

                <!-- Bottom info box -->
                <div class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur-md p-4 rounded-xl shadow-md">
                    <h3 class="text-md font-bold text-gray-800">{{ $umkm->judul }}</h3>
                    <p class="text-sm font-semibold text-emerald-600 mb-2">Rp{{ number_format($umkm->harga, 0, ',', '.') }}</p>
                    <div class="flex justify-between gap-2">
                        <a href="https://wa.me/{{ $umkm->kontak }}" target="_blank"
                            class="flex-1 bg-green-500 text-white py-1.5 px-3 rounded-md text-sm text-center hover:bg-yellow-600">Pesan</a>
                        <a href="{{ route('frontend.umkm.show', $umkm->slug) }}"
                            class="flex-1 bg-blue-500 text-white py-1.5 px-3 rounded-md text-sm text-center hover:bg-blue-600">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ url('/umkm') }}" class="inline-block bg-emerald-600 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-lg transition">Lihat Semua UMKM</a>
        </div>
    </div>
</section>

<section id="berita" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-emerald-600 mb-4">Berita Terbaru</h2>
        <p class="text-gray-600 text-center mb-12">Ikuti perkembangan terbaru di desa kami!</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($beritas->take(3) as $berita)
            <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer" onclick="window.location='{{ url('/berita/' . $berita->slug) }}'">

                <!-- Gambar + overlay hanya saat hover gambar -->
                <div class="relative group">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                        class="w-full h-48 object-cover">

                    <!-- Overlay dari atas -->
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center transform -translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-white text-3xl font-bold">+</span>
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-4">
                    <div class="bg-gray-200 text-gray-800 text-sm px-3 py-1 rounded-lg inline-block mb-4">
                        {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}
                    </div>
                    <h3 class="text-lg font-semibold mb-2">{{ $berita->judul }}</h3>
                    <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 100) }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ url('/berita') }}" class="inline-block bg-emerald-600 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-lg transition">Lihat Semua Berita</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    // Pastikan inisialisasi swiper dilakukan setelah DOM siap
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false, // Agar tidak berhenti setelah interaksi
            },
            effect: 'fade',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                type: 'bullets',
            },
        });
    });
</script>

@endpush