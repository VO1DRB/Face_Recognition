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
        <aside class="w-64 h-screen bg-gray-50 text-gray-800 flex flex-col hidden md:flex shadow-md">
            <!-- Logo -->
            <div class="p-4 border-b bg-white shadow-sm flex items-center justify-center">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-10">
            </div>

            <!-- Menu -->
            <div class="flex-1 overflow-y-auto">
                <ul class="p-4 space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" 
                        class="block px-4 py-2 rounded-md transition 
                                hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                            🏠 Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" 
                        class="block px-4 py-2 rounded-md transition 
                                hover:bg-gray-200 {{ request()->routeIs('users.*') ? 'bg-gray-200 font-semibold' : '' }}">
                            👤 Kelola User
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attendance.index') }}" 
                        class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('attendance.*') ? 'bg-gray-200 font-semibold' : '' }}">
                            📊 Attendance
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('devices.index') }}" 
                        class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('devices.*') ? 'bg-gray-200 font-semibold' : '' }}">
                            📡 Kelola Device
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Bagian bawah (User Info + Logout) -->
            <div class="p-4 border-t border-gray-200 bg-white">
                <a href="{{ route('profile.edit') }}" class="flex items-center mb-3 hover:bg-gray-100 p-2 rounded-md transition">
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center font-bold text-gray-700">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="ml-3">
                        <div class="font-semibold">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full text-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                        Log Out
                    </button>
                </form>
            </div>

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
