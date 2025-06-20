<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Ajouter une ligne au document #{{ $document->reference }}</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('lignes.store', $document) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label>Désignation</label>
                <input type="text" name="designation" required class="w-full rounded border-gray-300">
            </div>

            <div>
                <label>Quantité</label>
                <input type="number" name="quantite" value="1" min="1" required class="w-full rounded border-gray-300">
            </div>

            <div>
                <label>Prix unitaire</label>
                <input type="number" step="0.01" name="prix_unitaire" required class="w-full rounded border-gray-300">
            </div>

            <div class="flex justify-end">
                <button class="bg-green-600 text-white px-4 py-2 rounded">Ajouter ligne</button>
            </div>
        </form>
    </div>
</x-app-layout>
