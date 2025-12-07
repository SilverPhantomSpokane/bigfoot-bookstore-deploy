@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Departments</h1>
    @can('create', App\Models\Department::class)
    <a href="{{ route('departments.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">
        + Add Department
    </a>
    @endcan
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($departments as $department)
        <div class="bg-white p-5 rounded-xl shadow hover:shadow-md transition flex flex-col justify-between">
            <div class="flex-1">
                <h2 class="text-lg font-semibold text-gray-800 mb-3 text-center">
                    {{ ucfirst($department->name) }}
                </h2>
            </div>

            <div class="mt-3 space-y-2">
                <a href="{{ route('departments.show', $department) }}" 
                   class="block bg-blue-500 text-white py-1.5 rounded hover:bg-blue-600 text-center transition text-sm">
                    View
                </a>

                <div class="flex justify-center space-x-2">
                     @can('update', $department)
                    <a href="{{ route('departments.edit', $department) }}" 
                       class="flex-1 bg-green-500 text-white py-1.5 rounded hover:bg-green-600 text-center transition text-sm">
                        Edit
                    </a>
                    @endcan
                    @can('delete', $department)
                    <form action="{{ route('departments.destroy', $department) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this department?');" 
                          class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-red-500 text-white py-1.5 rounded hover:bg-red-600 text-center transition text-sm">
                            Delete
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-600 col-span-full text-center">No departments available yet.</p>
    @endforelse
</div>
@endsection
