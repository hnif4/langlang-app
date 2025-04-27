@extends('layouts.app')

@section('title', 'Edit Admin')

@section('content')

    <div class="container mx-auto py-6">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="aktif" {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak_aktif" {{ old('status', $user->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            {{-- Is Admin --}}
            <div class="mb-4">
                <label for="is_admin" class="block text-sm font-medium text-gray-700">Peran</label>
                <select name="is_admin" id="is_admin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="1" {{ old('is_admin', $user->is_admin) == '1' ? 'selected' : '' }}>Admin</option>
                    <option value="0" {{ old('is_admin', $user->is_admin) == '0' ? 'selected' : '' }}>User Biasa</option>
                </select>
            </div>

            {{-- Avatar Lama & Upload Baru --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Avatar Lama</label>
                @if($user->avatar)
                    <img src="{{ asset('storage/'.$user->avatar) }}" alt="Avatar" class="w-32 h-32 object-cover rounded mb-2">
                @else
                    <p class="text-sm text-gray-500 italic">Belum ada avatar.</p>
                @endif
                <label for="avatar" class="block text-sm font-medium text-gray-700 mt-2">Ganti Avatar</label>
                <input type="file" name="avatar" id="avatar" class="mt-1 block w-full" accept="image/*">
            </div>

            {{-- Tombol Update --}}
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
