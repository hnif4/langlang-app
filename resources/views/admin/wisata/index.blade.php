@extends('layouts.app')

@section('title', 'Daftar Wisata')

@section('content')

    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Wisata') }}
            </h2>
            <form action="{{ route('admin.wisata.index') }}" method="GET" class="flex items-center">
                <input type="text" name="query" value="{{ request('query') }}"
                    placeholder="Cari Wisata..."
                    class="border border-gray-300 rounded px-3 py-1 mr-2 focus:outline-none focus:ring">
                <button type="submit"
                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Cari
                </button>
            </form>
        </div>

    <!-- Tampilkan hasil pencarian jika ada, kecuali kalau query kosong -->
    @if(request()->has('query') && request('query') != '' && count($wisatas) > 0)
    <h3 class="text-xl mt-4">Hasil pencarian untuk: "{{ request('query') }}"</h3>
    @elseif(request()->has('query') && request('query') != '' && count($wisatas) == 0)
    <p>Maaf, tidak ada hasil ditemukan untuk: "{{ request('query') }}"</p>
    @endif

    <div class="container mx-auto py-6">
        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <a href="{{ route('admin.wisata.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Wisata
        </a>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded">
                <thead class="bg-blue-500 text-white text-center">
                    <tr>
                        <th class="px-4 py-2 border">Judul</th>
                        <th class="px-4 py-2 border">Deskripsi</th>
                        <th class="px-4 py-2 border">Lokasi</th>
                        <th class="px-4 py-2 border">Harga Tiket</th>
                        <th class="px-4 py-2 border">Jam Operasional</th>
                        <th class="px-4 py-2 border">Kontak</th>
                        <th class="px-4 py-2 border text-center">Gambar</th>
                        <th class="px-4 py-2 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wisatas as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $item->judul }}</td>
                        <td class="px-4 py-2 border">
                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 50, '...') }}
                        </td>
                        <td class="px-4 py-2 border">{{ $item->lokasi }}</td>
                        <td class="px-4 py-2 border">Rp{{ number_format($item->harga_tiket, 0, ',', '.') }}</td> <!-- Menampilkan harga tiket -->
                        <td class="px-4 py-2 border">{{ $item->jam_operasional ?? '-' }}</td>
                        <td class="px-4 py-2 border">
                            @if($item->kontak)
                            <a href="{{ $item->kontak }}" target="_blank" class="text-blue-500 underline">
                                {{ $item->kontak }}
                            </a>
                            @else
                            —
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">
                            @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                class="w-16 h-16 object-cover rounded inline-block"
                                alt="gambar wisata">
                            @else
                            —
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.wisata.show', $item->id) }}"
                                    class="bg-blue-500 text-white px-2 py-1 rounded text-sm">
                                    Detail
                                </a>
                                <a href="{{ route('admin.wisata.edit', $item->id) }}"
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        async function hapusData(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const res = await Swal.fire({
                title: 'Yakin hapus Wisata?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!'
            });
            if (!res.isConfirmed) return;

            fetch(`/admin/wisata/${id}`, {
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