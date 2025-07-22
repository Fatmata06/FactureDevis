<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-invoice text-white text-lg"></i>
                </div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    Liste des Documents (Devis / Factures)
                </h2>
            </div>
            <a href="{{ route('documents.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl font-medium shadow-lg flex items-center space-x-2 no-underline">
                <i class="fas fa-plus"></i>
                <span>Nouveau Document</span>
            </a>
        </div>
    </x-slot>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 10px 20px rgba(102,126,234,0.4); }
        .table-row { transition: all 0.2s ease; }
        .table-row:hover { background: linear-gradient(90deg, rgba(102,126,234,0.05) 0%, rgba(118,75,162,0.05) 100%); }
        .action-btn { transition: all 0.2s ease; }
        .action-btn:hover { transform: scale(1.05); }
        .empty-state { background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); }
    </style>

    <div class="py-8 bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 min-h-screen overflow-x-hidden">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden card-hover">


            <!-- Filtrage par type modernisé -->
            <form method="GET" action="{{ route('documents.index') }}" class="mb-8 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-3 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold shadow">
                        <i class="fas fa-filter mr-2"></i> Filtrer par type
                    </span>
                    <select name="type" id="type" onchange="this.form.submit()" class="rounded-xl px-4 py-2 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent min-w-[160px]">
                        <option value="">Documents</option>
                        <option value="devis" {{ request('type') == 'devis' ? 'selected' : '' }}>Devis</option>
                        <option value="facture" {{ request('type') == 'facture' ? 'selected' : '' }}>Factures</option>
                    </select>
                </div>
                @if(request('type'))
                    <a href="{{ route('documents.index') }}" class="ml-1 text-xs text-gray-500 hover:text-blue-600 transition underline flex items-center gap-1">
                        <i class="fas fa-times-circle"></i> Réinitialiser
                    </a>
                @endif
            </form>


            <!-- Table des documents -->
            <div class="overflow-x-auto max-w-full">
                <table class="min-w-full w-full text-center align-middle table-fixed">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">Référence</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">Date</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">Type</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">Entreprise</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">Client</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">Montant</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($documents as $document)
                            <tr class="table-row align-middle">
                                <td class="px-6 py-4 whitespace-nowrap align-middle">{{ $document->reference }}</td>
                                <td class="px-6 py-4 whitespace-nowrap align-middle">{{ $document->date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap align-middle capitalize">{{ $document->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap align-middle">{{ $document->entreprise->nom ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap align-middle">{{ $document->client->nom ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap align-middle">{{ number_format($document->montant_total, 2, ',', ' ') }} FCFA</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center align-middle">
                                    <div class="flex justify-center space-x-3 min-h-[44px]">
                                        <a href="{{ route('documents.edit', $document) }}" class="group relative text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span class="sr-only">Modifier</span>
                                            <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">Modifier</span>
                                        </a>
                                        <a href="{{ route('documents.pdf', $document) }}" class="group relative text-blue-600 dark:text-blue-400 hover:text-blue-800 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                                            </svg>
                                            <span class="sr-only">Télécharger</span>
                                            <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">Télécharger</span>
                                        </a>
                                        <form action="{{ route('documents.destroy', $document) }}" method="POST" onsubmit="return confirm('Supprimer ce document ?')" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="group relative text-red-600 dark:text-red-400 hover:text-red-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                <span class="sr-only">Supprimer</span>
                                                <span class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">Supprimer</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12">
                                    <div class="empty-state rounded-2xl p-10 flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-file-invoice text-4xl text-gray-400"></i>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Aucun document trouvé</h3>
                                        <p class="text-gray-500 dark:text-gray-400 mb-4">
                                            @if(request('type'))
                                                Aucun résultat pour ce filtre.
                                            @else
                                                Commencez par ajouter votre premier document (devis ou facture)
                                            @endif
                                        </p>
                                        <a href="{{ route('documents.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl font-medium shadow-lg inline-flex items-center space-x-2 no-underline">
                                            <i class="fas fa-plus"></i>
                                            <span>Nouveau Document</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($documents->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
                        {{ $documents->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
