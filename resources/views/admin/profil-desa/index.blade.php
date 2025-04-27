@extends('layouts.app')

@section('title', 'Daftar Profil Desa')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Profil Desa') }}
            </h2>
            <form action="{{ route('admin.profil-desa.index') }}" method="GET" class="flex items-center">
                <input type="text" name="query" value="{{ request('query') }}"
                    placeholder="Cari Profile Desa..."
                    class="border border-gray-300 rounded px-3 py-1 mr-2 focus:outline-none focus:ring">
                <button type="submit"
                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Cari
                </button>
            </form>
        </div>

     <!-- Tampilkan hasil pencarian jika ada, kecuali kalau query kosong -->
     @if(request()->has('query') && request('query') != '' && count($profildesa) > 0)
        <h3 class="text-xl mt-4">Hasil pencarian untuk: "{{ request('query') }}"</h3>
    @elseif(request()->has('query') && request('query') != '' && count($profildesa) == 0)
        <p>Maaf, tidak ada hasil ditemukan untuk: "{{ request('query') }}"</p>
    @endif

    <div class="container mx-auto py-6">
        @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <a href="{{ route('admin.profil-desa.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Profil Desa
        </a>

        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-blue-500 text-white text-center">
                <tr>
                    <th class="px-4 py-2 border">Judul</th>
                    <th class="px-4 py-2 border">Tipe</th>
                    <th class="px-4 py-2 border">Konten</th>
                    <th class="px-4 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profildesa as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $item->judul }}</td>
                    <td class="px-4 py-2 border">{{ $item->tipe }}</td>
                    <td class="px-4 py-2 border">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 50, '...') }}
                    </td>
                    <td class="px-4 py-2 border">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.profil-desa.show', $item->id) }}" class="bg-green-500 text-white px-3 py-1 rounded text-sm">Detail</a>
                            <a href="{{ route('admin.profil-desa.edit', $item->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                            <button onclick="hapusData('{{ $item->id }}')" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Hapus</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function hapusData(id) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            Swal.fire({
                title: 'Yakin hapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/profil-desa/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json',
                        }
                    }).then(res => res.json()).then(data => {
                        if (data.status === 'success') {
                            Swal.fire('Berhasil', data.message, 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Gagal', data.message || 'Terjadi kesalahan!', 'error');
                        }
                    }).catch(() => {
                        Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data!', 'error');
                    });
                }
            });
        }
    </script>
@endsection