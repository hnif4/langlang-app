<!-- resources/views/admin/categories/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

    <div class="container mx-auto py-6">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" name="nama" id="nama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" id="slug" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Simpan</button>
        </form>
    </div>
    @endsection
