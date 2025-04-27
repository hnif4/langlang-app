@extends('layouts.app')

@section('title', 'Daftar Admin')

@section('content')

    <div class="container mx-auto py-6">
        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <a href="{{ route('admin.users.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Tambah User Admin
        </a>

        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-blue-500 text-white text-center">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Avatar</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                    <td class="px-4 py-2 border">{{ $user->status }}</td>
                    <td class="px-4 py-2 border text-center">
                        @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}"
                            alt="avatar"
                            class="w-16 h-16 object-cover rounded inline-block">
                        @else
                        —
                        @endif
                    </td>

                    <td class="px-4 py-2 border">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">
                                Edit
                            </a>
                            <button onclick="hapusData('{{ $user->id }}')"
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
                title: 'Yakin hapus user?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!'
            });
            if (!res.isConfirmed) return;

            fetch(`/admin/users/${id}`, {
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
