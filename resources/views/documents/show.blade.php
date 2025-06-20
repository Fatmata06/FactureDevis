<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
            {{ $document->isFacture() ? 'Facture' : 'Devis' }} – {{ $document->reference }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 space-y-6">

            {{-- Infos principales --}}
            <div class="text-gray-800 dark:text-gray-200">
                <p><strong>Date :</strong> {{ $document->date }}</p>
                <p><strong>Client :</strong> {{ $document->client->nom }} {{ $document->client->prenom }}</p>
                <p><strong>Entreprise :</strong> {{ $document->entreprise->nom }}</p>
                <p><strong>Statut :</strong> {{ ucfirst($document->statut) }}</p>
            </div>

            {{-- Tableau des lignes --}}
            <div class="overflow-x-auto">
                <table class="w-full table-auto border border-gray-300 dark:border-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Désignation</th>
                            <th class="px-4 py-2 text-right">Quantité</th>
                            <th class="px-4 py-2 text-right">Prix unitaire</th>
                            <th class="px-4 py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($document->lignes as $ligne)
                            <tr class="border-t border-gray-300 dark:border-gray-600">
                                <td class="px-4 py-2">{{ $ligne->designation }}</td>
                                <td class="px-4 py-2 text-right">{{ $ligne->quantite }}</td>
                                <td class="px-4 py-2 text-right">{{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} €</td>
                                <td class="px-4 py-2 text-right">{{ number_format($ligne->total, 2, ',', ' ') }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-gray-300 dark:border-gray-600 font-bold bg-gray-50 dark:bg-gray-700">
                            <td colspan="3" class="px-4 py-2 text-right">Total</td>
                            <td class="px-4 py-2 text-right">{{ number_format($document->montant_total, 2, ',', ' ') }} €</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Bouton retour --}}
            <div class="flex justify-end">
                <a href="{{ route('documents.index') }}" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">
                    Retour
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
