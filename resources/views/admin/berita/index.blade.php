@extends('layouts.app')

@section('title', 'Daftar Berita')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Berita') }}
            </h2>
            <form action="{{ route('admin.berita.index') }}" method="GET" class="flex items-center">
                <input type="text" name="query" value="{{ request('query') }}"
                    placeholder="Cari berita..."
                    class="border border-gray-300 rounded px-3 py-1 mr-2 focus:outline-none focus:ring">
                <button type="submit"
                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Cari
                </button>
            </form>
        </div>

    <div class="container mx-auto py-6">
        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if(request()->filled('query') && count($beritas) > 0)
        <h3 class="text-xl">Hasil pencarian untuk: "{{ request('query') }}"</h3>
        <ul>
            @foreach($beritas as $berita)
            <li>{{ $berita->judul }}</li>
            @endforeach
        </ul>
        @elseif(request()->filled('query') && count($beritas) == 0)
        <p>Maaf, tidak ada hasil ditemukan untuk: "{{ request('query') }}"</p>
        @endif



        <a href="{{ route('admin.berita.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Berita
        </a>

        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-blue-500 text-white text-center">
                <tr>
                    <th class="px-4 py-2 border">Judul</th>
                    <th class="px-4 py-2 border">Konten</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Gambar</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($beritas as $item)
                <tr>
                    <td class="px-4 py-2 border">{{ $item->judul }}</td>
                    <td class="px-4 py-2 border">
                        {{ \Illuminate\Support\Str::limit($item->konten, 50, '...') }}
                    </td>
                    <td class="px-4 py-2 border">{{ $item->category->nama }}</td>
                    <td class="px-4 py-2 border text-center">
                        @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                            alt=""
                            class="w-16 h-16 object-cover rounded inline-block">
                        @else
                        —
                        @endif
                    </td>

                    <td class="px-4 py-2 border">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.berita.show', $item->id) }}"
                                class="bg-green-500 text-white px-2 py-1 rounded text-sm">
                                Detail
                            </a>
                            <a href="{{ route('admin.berita.edit', $item->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">
                                Edit
                            </a>
                            <button onclick="hapusData('{{ $item->id }}')"
                                class="bg-red-500 text-white px-2 py-1 rounded text-sm">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- SweetAlert + fetch() -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        async function hapusData(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const res = await Swal.fire({
                title: 'Yakin hapus berita?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!'
            });
            if (!res.isConfirmed) return;

            fetch(`/admin/berita/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(json => {
                    if (json.status === 'success') {
                        Swal.fire('Terhapus!', json.message, 'success')
                            .then(() => location.reload());
                    } else {
                        Swal.fire('Gagal', json.message, 'error');
                    }
                });
        }
    </script>
@endsection