
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-white text-lg"></i>
                </div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    Liste des Clients Finaux
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

    <div class="py-8 bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $clients->total() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Clients finaux</div>
                    </div>
                </div>
                <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $clients->unique('entreprise_id')->count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Entreprises clientes</div>
                    </div>
                </div>
                <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $clients->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Ajoutés ce mois</div>
                    </div>
                </div>
                <div class="stat-card dark:stat-card-dark rounded-2xl p-6 flex items-center space-x-4 shadow card-hover">
                    <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-pink-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-check text-white text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $clients->where('created_at', '>=', now()->startOfDay())->count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">Ajoutés aujourd'hui</div>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('clients_finaux.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl font-medium shadow-lg flex items-center space-x-2 no-underline">
                        <i class="fas fa-plus"></i>
                        <span>Ajouter un Client Final</span>
                    </a>
                   
                </div>
                <!-- Search Bar -->
                <div class="search-container">
                    <form method="GET" action="{{ route('clients_finaux.index') }}">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un client..." class="search-input pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent w-80 shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </form>
                </div> 
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="success-alert text-white px-6 py-4 rounded-xl mb-6 shadow-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-xl"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Main Content Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">
                @if($clients->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-center align-middle">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">
                                        <div class="flex items-center justify-center space-x-2">
                                            <i class="fas fa-hashtag text-gray-400"></i>
                                            <span>ID</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">
                                        <div class="flex items-center justify-center space-x-2">
                                            <span>Nom</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">
                                        <div class="flex items-center justify-center space-x-2">
                                            <span>Prénom</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">
                                        <div class="flex items-center justify-center space-x-2">
                                            <span>Entreprise Cliente</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">
                                        <div class="flex items-center justify-center space-x-2">
                                            <span>Actions</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($clients as $client)
                                    <tr class="table-row align-middle">
                                        <td class="px-6 py-4 whitespace-nowrap align-middle">
                                            <div class="flex items-center justify-center">
                                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                                    {{ $client->id }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap align-middle">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100 text-center">{{ $client->nom }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap align-middle">
                                            <div class="text-sm text-gray-900 dark:text-gray-100 text-center">{{ $client->prenom }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap align-middle">
                                            <div class="flex items-center justify-center">
                                                <i class="fas fa-building text-gray-400 mr-2"></i>
                                                <span class="text-sm text-gray-900 dark:text-gray-100">{{ $client->entreprise->nom ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center align-middle">
                                            <div class="flex items-center justify-center gap-3 min-h-[44px]">
                                                <a href="{{ route('clients_finaux.show', $client) }}" class="group relative text-blue-600 dark:text-blue-400 hover:text-blue-800 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    <span class="sr-only">Voir</span>
                                                    <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                        Voir
                                                    </span>
                                                </a>
                                                <a href="{{ route('clients_finaux.edit', $client) }}" class="group relative text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    <span class="sr-only">Modifier</span>
                                                    <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                        Modifier
                                                    </span>
                                                </a>
                                                <form action="{{ route('clients_finaux.destroy', $client) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client? Cette action est irréversible.')" class="inline-block">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="empty-state rounded-2xl p-12 text-center">
                        <div class="w-24 h-24 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-users text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Aucun client trouvé</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">
                            @if(request('search'))
                                Aucun résultat pour "{{ request('search') }}"
                            @else
                                Commencez par ajouter votre premier client final
                            @endif
                        </p>
                        <a href="{{ route('clients_finaux.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl font-medium shadow-lg inline-flex items-center space-x-2 no-underline">
                            <i class="fas fa-plus"></i>
                            <span>Ajouter un Client</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($clients->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
                        {{ $clients->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Confirmer la suppression</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-2">Êtes-vous sûr de vouloir supprimer le client :</p>
                <p class="font-semibold text-gray-900 dark:text-gray-100 mb-4" id="clientName"></p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Cette action est irréversible.</p>
                <div class="flex space-x-4">
                    <button onclick="hideDeleteModal()" class="flex-1 px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-600 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors">Annuler</button>
                    <form id="deleteForm" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(clientId, nom, prenom) {
            document.getElementById('clientName').textContent = `${prenom} ${nom}`;
            document.getElementById('deleteForm').action = `/clients-finaux/${clientId}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
        // Auto-submit search form with debounce
        let searchTimeout;
        document.querySelector('input[name="search"]').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
        // Auto-hide success alert
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.querySelector('.success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.opacity = '0';
                    setTimeout(() => {
                        successAlert.remove();
                    }, 300);
                }, 4000);
            }
        });
    </script>
</x-app-layout>