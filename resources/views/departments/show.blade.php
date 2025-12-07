@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">{{ ucfirst($department->name) }}</h1>
    {{--change route for button--}}

    @can('create', App\Models\Product::class)
  <a href="{{ route('departments.products.create', $department) }}" 
   class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
    + Add Product
</a>
@endcan
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($products as $product)
        <div class="bg-white p-4 shadow rounded flex flex-col justify-between hover:shadow-lg transition">
            {{-- image --}}
            @if($product->image)
                <img src="{{ asset($product->image) }}" 
                     class="w-full h-48 object-cover rounded mb-2" 
                     alt="{{ $product->name }}">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 rounded mb-2">
                    No image
                </div>
            @endif

            {{-- text --}}
            <div class="flex-1">
                <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                <p class="text-gray-700">${{ number_format($product->price, 2) }}</p>
                <p class="text-sm text-gray-500 mt-2">{{ $product->description }}</p>
            </div>

            {{-- buttons --}}
            <div class="mt-4 flex justify-center space-x-2">
                   @can('update', $product)
                <a href="{{ route('products.edit', $product) }}"
                   class="flex-1 bg-green-500 text-white py-1.5 rounded hover:bg-green-600 text-center text-sm transition">
                    Edit
                </a>
                @endcan
                @can('delete', $product)

                <form action="{{ route('products.destroy', $product) }}" 
                      method="POST" class="flex-1"
                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-red-500 text-white py-1.5 rounded hover:bg-red-600 text-sm transition">
                        Delete
                    </button>
                </form>
                @endcan
            </div>
        </div>
    @empty
        <p class="text-gray-600 col-span-full text-center">
            No products in this department yet.
        </p>
    @endforelse
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>

<a href="{{ route('departments.index') }}" 
   class="inline-block mt-6 text-blue-600 hover:underline">
    ← Back to Departments
</a>
@endsection
