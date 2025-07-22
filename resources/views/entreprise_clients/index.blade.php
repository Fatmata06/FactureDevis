<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-building text-white text-lg"></i>
                </div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    Liste des Entreprises Clientes
                </h2>
            </div>
           
        </div>
    </x-slot>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 10px 20px rgba(102,126,234,0.4); }
        .table-row { transition: all 0.2s ease; }
        .table-row:hover { background: linear-gradient(90deg, rgba(102,126,234,0.05) 0%, rgba(118,75,162,0.05) 100%); }
        .success-alert { background: linear-gradient(135deg, #10b981 0%, #059669 100%); animation: slideIn 0.5s ease-out; }
        @keyframes slideIn { from { transform: translateX(-100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        .action-btn { transition: all 0.2s ease; }
        .action-btn:hover { transform: scale(1.05); }
        .empty-state { background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); }
        .search-container { position: relative; }
        .search-input { transition: all 0.3s ease; }
        .search-input:focus { box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
        .stat-card { background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%); }
        .stat-card-dark { background: linear-gradient(135deg, #1e293b 0%, #312e81 100%); }
    </style>
    <!-- Main container with improved styling -->
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-8 overflow-x-hidden">
        <!-- Stats summary cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-building text-white text-2xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $entreprises->total() }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">Entreprises clientes</div>
                </div>
            </div>
            <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-layer-group text-white text-2xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $entreprises->unique('domaine')->count() }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">Domaines d'activité</div>
                </div>
            </div>
            <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-plus text-white text-2xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $entreprises->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">Ajoutées ce mois</div>
                </div>
            </div>
            <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-pink-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-check text-white text-2xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $entreprises->where('created_at', '>=', now()->startOfDay())->count() }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-300">Ajoutées aujourd'hui</div>
                </div>
            </div>
        </div>
        <!-- Action Bar -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('entreprise_clients.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl font-medium shadow-lg flex items-center space-x-2 no-underline">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter une Entreprise</span>
                </a>
               
            </div>
            <!-- Search Bar -->
            <div class="search-container">
                <form method="GET" action="{{ route('entreprise_clients.index') }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une entreprise..." class="search-input pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent w-80 shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </form>
            </div>
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
         
            <!-- Enhanced table -->
            <div class="overflow-x-auto max-w-full">
                <table class="min-w-full w-full divide-y divide-gray-200 dark:divide-gray-700 table-fixed">
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
