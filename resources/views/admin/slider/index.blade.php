@extends('layouts.app')

@section('title', 'Data Slider')

@section('content')
    <div class="container mx-auto py-6">
        <a href="{{ route('admin.slider.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Slider</a>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($items as $item)
                <div class="bg-white p-4 rounded shadow">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full rounded mb-2" alt="slider">
                    @endif
                    <p><strong>Link:</strong> <a href="{{ $item->link }}" target="_blank" class="text-blue-600">{{ $item->link }}</a></p>

                    <div class="mt-3">
                        <a href="{{ route('admin.slider.edit', $item->id) }}" class="text-sm bg-yellow-500 text-white px-3 py-1 rounded mr-1">Edit</a>
                        <form action="{{ route('admin.slider.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
