<x-app-layout>
    <x-slot name="header">
        <!-- Enhanced header with improved styling and animation -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div class="flex items-center space-x-3">
                <div class="bg-gradient-to-r from-blue-600 to-teal-500 rounded-lg p-2 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-wide bg-gradient-to-r from-blue-600 to-teal-500 bg-clip-text text-transparent">
                    Liste des entreprises clientes
                </h2>
            </div>
            <a href="{{ route('entreprise_clients.create') }}" class="group flex items-center bg-gradient-to-r from-blue-600 to-teal-500 hover:from-blue-700 hover:to-teal-600 text-white font-bold px-6 py-3 rounded-lg shadow-xl transition-all duration-300 ease-out transform hover:-translate-y-1 hover:shadow-2xl">
                <svg class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="relative">
                    Ajouter une entreprise
                    <span class="absolute bottom-0 left-0 w-0 group-hover:w-full h-0.5 bg-white transition-all duration-300"></span>
                </span>
            </a>
        </div>
    </x-slot>
    <!-- Main container with improved styling -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats summary cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total companies -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg p-6 border border-blue-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Total Entreprises</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $entreprises->total() }}</p>
                            <p class="ml-2 text-sm text-gray-600 dark:text-gray-400">entreprises</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active domains -->
            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg p-6 border border-emerald-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-emerald-500 bg-opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Domaines d'activité</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $entreprises->unique('domaine')->count() }}</p>
                            <p class="ml-2 text-sm text-gray-600 dark:text-gray-400">secteurs</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last added -->
            <div class="bg-gradient-to-br from-violet-50 to-violet-100 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg p-6 border border-violet-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-violet-500 bg-opacity-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-violet-600 dark:text-violet-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Dernière ajoutée</h3>
                        <div class="flex items-baseline">
                            <p class="text-lg font-bold text-gray-900 dark:text-white truncate max-w-[150px]">
                                {{ $entreprises->first() ? $entreprises->sortByDesc('created_at')->first()->nom : 'Aucune' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Enhanced search and filter bar -->
        <div class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
            <form action="{{ route('entreprise_clients.index') }}" method="GET" class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex-1">
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md" placeholder="Rechercher une entreprise...">
                    </div>
                </div>
                <div class="w-full md:w-1/4">
                    <select name="domaine" class="focus:ring-blue-500 focus:border-blue-500 block w-full p-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md">
                        <option value="">Tous les domaines</option>
                        @foreach($entreprises->unique('domaine')->pluck('domaine') as $domaine)
                            <option value="{{ $domaine }}" {{ request('domaine') == $domaine ? 'selected' : '' }}>{{ $domaine }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm rounded-md font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filtrer
                </button>
            </form>
        </div>

        <!-- Success message with animation -->
        @if(session('success'))
            <div id="success-alert" class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 shadow-md flex items-center animate-fade-in-down">
                <svg class="w-5 h-5 mr-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>{{ session('success') }}</span>
                <button onclick="document.getElementById('success-alert').remove()" class="ml-auto">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        @endif
        <!-- Main content card with improved styling -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700 transition-all duration-300">
            <!-- Table header with gradient -->
            <div class="bg-gradient-to-r from-blue-600 to-teal-500 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-white">Répertoire des entreprises</h2>
            </div>

            <!-- Enhanced table -->
            <div>
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nom</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Domaine</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Téléphone</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Adresse</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($entreprises as $entreprise)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                       
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $entreprise->nom }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $entreprise->domaine }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    @if($entreprise->email)
                                        <div class="flex items-center">
                                        
                                            <span>{{ $entreprise->email }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    @if($entreprise->telephone)
                                        <div class="flex items-center">
                                           
                                            <span>{{ $entreprise->telephone }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    @if($entreprise->adresse)
                                        <div class="flex items-center">
                                            
                                            <span class="truncate max-w-[200px]">{{ $entreprise->adresse }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('entreprise_clients.show', $entreprise) }}" class="group relative text-blue-600 dark:text-blue-400 hover:text-blue-800 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span class="sr-only">Voir</span>
                                            <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                Voir
                                            </span>
                                        </a>
                                        <a href="{{ route('entreprise_clients.edit', $entreprise) }}" class="group relative text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span class="sr-only">Modifier</span>
                                            <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                Modifier
                                            </span>
                                        </a>
                                        <form action="{{ route('entreprise_clients.destroy', $entreprise) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise? Cette action est irréversible.')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="group relative text-red-600 dark:text-red-400 hover:text-red-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span class="sr-only">Supprimer</span>
                                                <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    Supprimer
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <span class="text-lg font-medium text-gray-500 dark:text-gray-400">Aucune entreprise enregistrée</span>
                                        <p class="text-gray-500 dark:text-gray-400 mt-2">Ajoutez votre première entreprise en cliquant sur le bouton ci-dessus</p>
                                        <a href="{{ route('entreprise_clients.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Ajouter une entreprise
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Improved pagination with better styling -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-700">
                <div class="pagination-container">
                    {{ $entreprises->links() }}
                </div>

                <!-- Custom pagination styling -->
                <style>
                    .pagination-container nav {
                        display: flex;
                        justify-content: center;
                    }
                    .pagination-container .flex.justify-between {
                        display: none;
                    }
                    .pagination-container .relative.inline-flex {
                        @apply rounded-md shadow-sm;
                    }
                    .pagination-container span[aria-current="page"] span {
                        @apply bg-blue-600 border-blue-600 text-white relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md;
                    }
                    .pagination-container a {
                        @apply bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors;
                    }
                </style>
            </div>
        </div>
    </div>
</x-app-layout>
