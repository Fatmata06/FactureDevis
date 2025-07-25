<!-- resources/views/layouts/navigation.blade.php -->
<aside x-data="{ open: true }" class="w-64 min-h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col fixed top-0 left-0 z-40 h-screen">
    <!-- Logo -->
    <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200 dark:border-gray-700">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="h-8 w-auto text-gray-800 dark:text-gray-200" />
        </a>
        <button @click="open = !open" class="sm:hidden text-gray-500 dark:text-gray-400 focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path :class="{'hidden': !open, 'inline-flex': open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                <path :class="{'hidden': open, 'inline-flex': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav :class="{'block': open, 'hidden': !open}" class="flex-1 px-4 py-2 space-y-2">
       <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <i class="fas fa-home"></i> Tableau de bord
        </x-nav-link>

        <x-nav-link :href="route('entreprise_clients.index')" :active="request()->routeIs('entreprise_clients.*')">
            <i class="fas fa-building"></i> Entreprises
        </x-nav-link>

        <x-nav-link :href="route('clients_finaux.index')" :active="request()->routeIs('clients_finaux.*')">
            <i class="fas fa-user-tie"></i> Clients finaux
        </x-nav-link>

        <x-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.*')">
            <i class="fas fa-file-alt"></i> Documents
        </x-nav-link>

    </nav>

    <!-- Footer / Logout -->
    <div class="mt-auto px-4 py-6 border-t border-gray-200 dark:border-gray-700 flex flex-col items-center">
        <div class="flex flex-col items-center mb-3">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center shadow">
                <i class="fas fa-user text-white text-2xl"></i>
            </div>
            <div class="text-base font-bold text-gray-700 dark:text-gray-200 mt-2">{{ Auth::user()->name }}</div>
            <span class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="w-full flex justify-center">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 font-semibold hover:bg-red-200 dark:hover:bg-red-800 transition">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>
</aside>
