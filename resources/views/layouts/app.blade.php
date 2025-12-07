<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

    <div class="min-h-screen flex flex-col">

        {{-- Top Navigation --}}
        @include('layouts.navigation')

        {{-- Page Content --}}
        <main class="py-6 flex-grow">
            <div class="max-w-7xl mx-auto px-6">
                @yield('content')
            </div>
        </main>

        {{-- Footer inside container --}}
        <footer class="mt-auto">
            <div class="max-w-7xl mx-auto px-6">
                @include('layouts.footer')
            </div>
        </footer>

    </div>

</body>
</html>
