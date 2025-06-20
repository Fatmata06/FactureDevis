<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            Modifier la ligne du document : {{ $document->reference }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">

            <form action="{{ route('ligne-documents.update', $ligneDocument->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="designation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Désignation <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="designation" id="designation" value="{{ old('designation', $ligneDocument->designation) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                    @error('designation')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="quantite" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Quantité <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="quantite" id="quantite" value="{{ old('quantite', $ligneDocument->quantite) }}" min="1" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                    @error('quantite')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="prix_unitaire" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Prix Unitaire <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="prix_unitaire" id="prix_unitaire" value="{{ old('prix_unitaire', $ligneDocument->prix_unitaire) }}" min="0" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                    @error('prix_unitaire')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('documents.ligne-documents.index', $document->id) }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Mettre à jour
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
