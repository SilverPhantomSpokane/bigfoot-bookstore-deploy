@extends('layouts.app')

@section('content')
@can('update', $product)
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Product</h1>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Department --}}
        <div class="mb-4">
            <label for="department_id" class="block font-semibold mb-1">Department</label>
            <p class="mb-2 text-gray-700">{{ ucfirst($product->department->name) }}</p>
         
        </div>

        {{-- Name --}}
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name', $product->name) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Price --}}
        <div class="mb-4">
            <label for="price" class="block font-semibold mb-1">Price</label>
            <input type="number" step="0.01" name="price" id="price" 
                   value="{{ old('price', $product->price) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            @error('price')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Image --}}
        <div class="mb-4">
            <label for="image" class="block font-semibold mb-1">Product Image</label>
            @if($product->image)
                <div class="mb-2">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-32 rounded shadow">
                </div>
            @endif
            <input type="file" name="image" id="image"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end space-x-2 mt-6">
            <a href="{{ url()->previous() }}" 
               class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
                Cancel
            </a>
            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endcan

@cannot('update', $product)
<div class="text-center text-gray-600 text-lg mt-10">
    You do not have permission to edit this product.
</div>
@endcannot
@endsection
