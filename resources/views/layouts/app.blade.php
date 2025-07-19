<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FactureDevis') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased" x-data="{ sidebarOpen: false }">

<div class="min-h-screen flex bg-gray-100 dark:bg-gray-900">

    <!-- Overlay (mobile only) -->
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden"
    ></div>

    <!-- Sidebar -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen">

        <!-- Mobile Topbar -->
        <div class="md:hidden bg-white dark:bg-gray-800 p-4 flex justify-between items-center w-full shadow">
            <button @click="sidebarOpen = !sidebarOpen">
                <svg class="h-6 w-6 text-gray-700 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="font-bold text-gray-800 dark:text-white text-lg">FactureDevis</span>
        </div>

        <!-- Page Header -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1 p-4">
            {{ $slot }}
        </main>
    </div>
</div>

</body>
</html>
