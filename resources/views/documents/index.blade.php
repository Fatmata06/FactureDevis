<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                Liste des Documents (Devis / Factures)
            </h2>
            <a href="{{ route('documents.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nouveau Document
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            {{-- Filtrage par type --}}
            <form method="GET" action="{{ route('documents.index') }}" class="mb-4">
                <select name="type" onchange="this.form.submit()" class="rounded p-2 border-gray-300">
                    <option value="">-- Tous les documents --</option>
                    <option value="devis" {{ request('type') == 'devis' ? 'selected' : '' }}>Devis</option>
                    <option value="facture" {{ request('type') == 'facture' ? 'selected' : '' }}>Factures</option>
                </select>
            </form>

            {{-- Table des documents --}}
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="border px-4 py-2">Référence</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Type</th>
                        <th class="border px-4 py-2">Entreprise</th>
                        <th class="border px-4 py-2">Client</th>
                        <th class="border px-4 py-2">Montant</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                        <tr>
                            <td class="border px-4 py-2">{{ $document->reference }}</td>
                            <td class="border px-4 py-2">{{ $document->date }}</td>
                            <td class="border px-4 py-2 capitalize">{{ $document->type }}</td>
                            <td class="border px-4 py-2">{{ $document->entreprise->nom ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $document->client->nom ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ number_format($document->montant_total, 2, ',', ' ') }} FCFA</td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="{{ route('documents.edit', $document) }}" class="text-yellow-500 hover:underline">✏️</a>
                                <a href="{{ route('documents.pdf', $document) }}" class="text-blue-600 hover:underline">📄</a>
                                <form action="{{ route('documents.destroy', $document) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Supprimer ce document ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">Aucun document trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $documents->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
