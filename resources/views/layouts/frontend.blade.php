<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Langlang Desa Wisata')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">




    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 font-sans">

<nav class="fixed top-0 left-0 w-full z-50 bg-white/30 backdrop-blur-md text-gray-800 transition duration-300" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between h-16"> <!-- navbar dengan tinggi tetap -->
    
        <!-- Logo -->
        <div class="flex-shrink-0">
        <img src="{{ asset('images/logo-desa-wisata.png') }}" alt="Logo Desa Wisata" class="h-16 sm:h-36 w-auto"><!-- gambar lebih besar -->
        </div>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex flex-grow justify-center space-x-4 font-medium text-base">
                <li><a href="/" class="hover:text-yellow-300 transition">Beranda</a></li>
                <li><a href="/profil-desa" class="hover:text-yellow-300 transition">Tentang Desa</a></li>
                <li class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="hover:text-yellow-300 transition">Kategori</button>
                    <ul x-show="open" x-transition class="absolute right-0 bg-white text-gray-800 mt-2 rounded shadow-md p-2 space-y-2 z-50 min-w-[150px]">
                        @foreach ($categories as $category)
                        @php $nama = strtolower($category->nama); @endphp
                        <li>
                            @if ($nama === 'wisata')
                            <a href="{{ route('frontend.wisata.index') }}" class="block px-4 py-2 hover:text-yellow-500 hover:bg-gray-100 rounded">Wisata</a>
                            @elseif ($nama === 'umkm')
                            <a href="{{ route('frontend.umkm.index') }}" class="block px-4 py-2 hover:text-yellow-500 hover:bg-gray-100 rounded">UMKM</a>
                            @elseif ($nama === 'berita')
                            <a href="{{ route('berita.index') }}" class="block px-4 py-2 hover:text-yellow-500 hover:bg-gray-100 rounded">Berita</a>
                            @else
                            <a href="{{ url('/kategori/' . $category->slug) }}" class="block px-4 py-2 hover:text-yellow-500 hover:bg-gray-100 rounded">{{ $category->nama }}</a>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>

            <!-- Search & Login (desktop) -->
            <div class="hidden md:flex items-center space-x-4">
                <form action="{{ route('search') }}" method="get" class="relative">
                    <input type="text" name="query" placeholder="Cari..." class="w-32 sm:w-40 px-3 py-1 border rounded-lg bg-white/30 backdrop-blur-sm text-emerald-600 placeholder-emerald-600 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </form>
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/admin/dashboard') }}" class="p-2 rounded hover:border hover:border-yellow-300 transition" title="Dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                        <path d="M18 1.5c2.9 0 5.25 2.35 5.25 5.25v3.75a.75.75 0 0 1-1.5 0V6.75a3.75 3.75 0 1 0-7.5 0v3a3 3 0 0 1 3 3v6.75a3 3 0 0 1-3 3H3.75a3 3 0 0 1-3-3v-6.75a3 3 0 0 1 3-3h9v-3c0-2.9 2.35-5.25 5.25-5.25Z" />
                    </svg>
                </a>
                @else
                <a href="{{ route('login') }}" class="p-2 rounded hover:border hover:border-yellow-300 transition" title="Log in">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                </a>
                @endauth
                @endif
            </div>

            <!-- Hamburger (Mobile Only) -->
            <div class="md:hidden">
                <button @click="open = !open" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="open" class="md:hidden px-6 pb-4 space-y-2 bg-white/70 backdrop-blur-md">
            <a href="/" class="block py-2 hover:text-yellow-400">Beranda</a>
            <a href="/profil-desa" class="block py-2 hover:text-yellow-400">Tentang Desa</a>

            @foreach ($categories as $category)
            @php $nama = strtolower($category->nama); @endphp
            @if ($nama === 'wisata')
            <a href="{{ route('frontend.wisata.index') }}" class="block py-2 hover:text-yellow-400">Wisata</a>
            @elseif ($nama === 'umkm')
            <a href="{{ route('frontend.umkm.index') }}" class="block py-2 hover:text-yellow-400">UMKM</a>
            @elseif ($nama === 'berita')
            <a href="{{ route('berita.index') }}" class="block py-2 hover:text-yellow-400">Berita</a>
            @else
            <a href="{{ url('/kategori/' . $category->slug) }}" class="block py-2 hover:text-yellow-400">{{ $category->nama }}</a>
            @endif
            @endforeach

            <form action="{{ route('search') }}" method="get" class="pt-2">
                <input type="text" name="query" placeholder="Cari..." class="w-full px-3 py-2 border rounded bg-white text-sm text-gray-800">
            </form>

            @if (Route::has('login'))
            @auth
            <a href="{{ url('/admin/dashboard') }}" class="block py-2 hover:text-yellow-400">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="block py-2 hover:text-yellow-400">Login</a>
            @endauth
            @endif
        </div>

    </nav>

    {{-- Konten --}}
    <main class="mt-12 px-6 lg:px-16">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-emerald-600 text-white pt-12 pb-6 mt-16">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Info Umum -->
            <div>
                <h2 class="text-xl font-semibold text-white mb-4">Langlang Desa Wisata</h2>
                <p class="text-sm leading-relaxed">
                    Jelajahi keindahan desa kami yang penuh budaya, kehangatan masyarakat, dan pesona alam yang tak terlupakan.
                </p>
                <br>
                <h2 class="text-xl font-semibold text-white mb-4">Kontak Kami</h2>
                <p class="text-sm mt-2 flex items-center">
                    <i class="fas fa-envelope mr-2 text-yellow-400"></i> Langlang@desawisata.id
                </p>
                <p class="text-sm mt-2 flex items-center">
                    <i class="fas fa-phone mr-2 text-yellow-400"></i> +62 812-3456-7890
                </p>
            </div>

            <!-- Navigasi -->
            <div>
                <h2 class="text-xl font-semibold text-white mb-4">Navigasi</h2>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="hover:text-yellow-400 transition">Beranda</a></li>
                    <li><a href="/profil-desa" class="hover:text-yellow-400 transition">Profil Desa</a></li>
                    <li><a href="/berita" class="hover:text-yellow-400 transition">Berita Terkini</a></li>
                    <li><a href="/umkm" class="hover:text-yellow-400 transition">UMKM</a></li>
                    <li><a href="/wisata" class="hover:text-yellow-400 transition">Wisata</a></li>
                </ul>
            </div>


            <!-- Lokasi / Peta -->
            <div>
                <h2 class="text-xl font-semibold text-white mb-4">Lokasi Kami</h2>
                <p class="text-sm">Jl. Pangkajene, Makassar, Sulawesi Selatan</p>
                <div class="rounded overflow-hidden border-2 border-gray-700">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2035607.5967273898!2d119.55717339860873!3d-4.805039207728709!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dc771a457beb741%3A0x10decafd8d0aeb25!2sKabupaten%20Pangkajene%20Dan%20Kepulauan%2C%20Sulawesi%20Selatan!5e0!3m2!1sid!2sid!4v1745659509122!5m2!1sid!2sid"
                        width="100%"
                        height="200"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="mt-10 border-t border-gray-700 pt-4 text-center text-sm text-white">
            &copy; {{ date('Y') }} Langlang Desa Wisata. Dibuat dengan ❤️ oleh Hanifah, Salwa, dan Zabian.
        </div>
    </footer>

    @stack('scripts')

</body>

</html>