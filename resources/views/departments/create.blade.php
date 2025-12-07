@extends('layouts.app')

@section('content')
@can('create', App\Models\Department::class)
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Add New Department</h1>

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf

        {{-- Department Name --}}
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Department Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end space-x-2 mt-6">
            <a href="{{ route('departments.index') }}" 
               class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
                Cancel
            </a>
            <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Save
            </button>
        </div>
    </form>
</div>
@endcan

{{-- If user is not allowed --}}
@cannot('create', App\Models\Department::class)
<div class="text-center text-gray-600 text-lg mt-10">
    You do not have permission to add departments.
</div>
@endcannot
@endsection
