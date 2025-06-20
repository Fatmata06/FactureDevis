<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            Lignes du document : {{ $document->reference }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4 flex justify-end">
            <a href="{{ route('documents.ligne-documents.create', $document->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Ajouter une ligne
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($lignes->count())
            <table class="min-w-full bg-white dark:bg-gray-800 shadow rounded">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b">Désignation</th>
                        <th class="px-6 py-3 border-b">Quantité</th>
                        <th class="px-6 py-3 border-b">Prix Unitaire</th>
                        <th class="px-6 py-3 border-b">Total</th>
                        <th class="px-6 py-3 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lignes as $ligne)
                    <tr>
                        <td class="border-b px-6 py-4">{{ $ligne->designation }}</td>
                        <td class="border-b px-6 py-4">{{ $ligne->quantite }}</td>
                        <td class="border-b px-6 py-4">{{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} €</td>
                        <td class="border-b px-6 py-4">{{ number_format($ligne->total, 2, ',', ' ') }} €</td>
                        <td class="border-b px-6 py-4 space-x-2">
                            <a href="{{ route('ligne-documents.edit', $ligne->id) }}" class="text-blue-600 hover:underline">Modifier</a>

                            <form action="{{ route('ligne-documents.destroy', $ligne->id) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette ligne ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $lignes->links() }}
            </div>
        @else
            <p>Aucune ligne pour ce document.</p>
        @endif
    </div>
</x-app-layout>
