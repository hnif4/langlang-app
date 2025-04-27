@extends('layouts.app')

@section('title', 'Edit Slider')

@section('content')

    <div class="container mx-auto py-6">
        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>

                {{-- Preview gambar lama --}}
                @if($slider->image)
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Gambar Slider" class="w-64 mb-2 rounded">
                @endif

                <input type="file" name="image" id="image" accept="image/*"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <p class="text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar.</p>
            </div>

            <div class="mb-4">
                <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                <input type="url" name="link" id="link" value="{{ old('link', $slider->link) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
