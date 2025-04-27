@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Kategori') }}
            </h2>
            <form action="{{ route('admin.categories.index') }}" method="GET" class="flex items-center">
                <input type="text" name="query" value="{{ request('query') }}"
                    placeholder="Cari Kategori..."
                    class="border border-gray-300 rounded px-3 py-1 mr-2 focus:outline-none focus:ring">
                <button type="submit"
                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Cari
                </button>
            </form>
        </div>

    <!-- Tampilkan hasil pencarian jika ada, kecuali kalau query kosong -->
    @if(request()->has('query') && request('query') != '' && count($categories) > 0)
        <h3 class="text-xl mt-4">Hasil pencarian untuk: "{{ request('query') }}"</h3>
    @elseif(request()->has('query') && request('query') != '' && count($categories) == 0)
        <p>Maaf, tidak ada hasil ditemukan untuk: "{{ request('query') }}"</p>
    @endif

    <div class="container mx-auto py-6">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        

        <a href="{{ route('admin.categories.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah Kategori
        </a>

        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-blue-500 text-white text-center">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $category->nama }}</td>
                        <td class="px-4 py-2 border text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.categories.show', $category->id) }}"
                                    class="bg-green-500 text-white px-2 py-1 rounded text-sm">
                                    Detail
                                </a>
                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                    class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">
                                    Edit
                                </a>
                                <button data-id="{{ $category->id }}"
                                    onclick="destroy(this)"
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    async function destroy(button) {
        const id = button.dataset.id;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const confirm = await Swal.fire({
            title: 'APAKAH KAMU YAKIN?',
            text: "INGIN MENGHAPUS DATA INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        });

        if (confirm.isConfirmed) {
            try {
                const response = await fetch(`/admin/categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.status === "success") {
                    await Swal.fire('BERHASIL!', data.message, 'success');
                    location.reload();
                } else {
                    Swal.fire('GAGAL!', data.message || 'DATA GAGAL DIHAPUS!', 'error');
                }
            } catch (error) {
                Swal.fire('GAGAL!', 'Terjadi kesalahan saat menghapus data!', 'error');
            }
        }
    }
</script>
@endsection
