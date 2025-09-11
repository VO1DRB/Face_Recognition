<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Face Recognition') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-4 text-xl font-bold border-b">
                {{ config('app.name', 'Laravel') }}
            </div>
            <nav class="mt-6 space-y-1">
                <a href="{{ route('dashboard') }}" 
                   class="block px-6 py-3 hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                    🏠 Dashboard
                </a>
                <a href="{{ route('users.index') }}" 
                   class="block px-6 py-3 hover:bg-gray-200 {{ request()->routeIs('users.*') ? 'bg-gray-200 font-semibold' : '' }}">
                    👤 Kelola User
                </a>
            </nav>
        </aside>

        <!-- Page Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navigation atas -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="p-4">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
