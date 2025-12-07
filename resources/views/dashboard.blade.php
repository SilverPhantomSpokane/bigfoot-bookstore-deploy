@extends('layouts.app')

@section('content')
 <div class="max-w-5xl mx-auto px-6 py-10">

        <div class="bg-white p-10 rounded-xl shadow border border-gray-200">

            <!-- TITLE BLOCK -->
            <div class="mb-8 mt-4 ml-4">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 flex items-center gap-3">
                    Bigfoot Bookstore 
                    <span class="text-3xl text-indigo-500">👣</span>
                </h1>

                <p class="mt-4 text-lg text-gray-600 leading-relaxed border-l-4 border-indigo-400 pl-4">
                    Welcome to my CIS-233 Laravel project — a small full-stack application where you can
                    manage Departments & Products, test user roles (Admin, Manager, User), and explore
                    Laravel routing, authorization, and cloud deployment.
                </p>
            </div>

            <!-- CARDS GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">

                <a href="{{ route('departments.index') }}"
                   class="flex flex-col items-center p-6 rounded-xl bg-blue-50 hover:bg-blue-100 transition shadow-sm border border-blue-200">
                    <h3 class="text-lg font-semibold text-blue-700">Departments</h3>
                    <p class="text-gray-600 mt-2 text-sm text-center">Manage book categories</p>
                </a>

                <a href="{{ route('departments.index') }}"
                   class="flex flex-col items-center p-6 rounded-xl bg-green-50 hover:bg-green-100 transition shadow-sm border border-green-200">
                    <h3 class="text-lg font-semibold text-green-700">Products</h3>
                    <p class="text-gray-600 mt-2 text-sm text-center">Add & edit books</p>
                </a>

               

            </div>

        </div>

    </div>
@endsection
