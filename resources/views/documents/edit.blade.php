<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Modifier {{ ucfirst($document->type) }} - {{ $document->reference }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <form action="{{ route('documents.update', $document) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="entreprise_client_id" class="block font-medium text-sm text-gray-700">Entreprise</label>
                        <select name="entreprise_client_id" id="entreprise_client_id" class="mt-1 block w-full">
                            @foreach($entreprises as $entreprise)
                                <option value="{{ $entreprise->id }}" {{ $document->entreprise_client_id == $entreprise->id ? 'selected' : '' }}>
                                    {{ $entreprise->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="client_final_id" class="block font-medium text-sm text-gray-700">Client</label>
                        <select name="client_final_id" id="client_final_id" class="mt-1 block w-full">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $document->client_final_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->prenom }} {{ $client->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="reference" class="block font-medium text-sm text-gray-700">Référence</label>
                        <input type="text" name="reference" id="reference" value="{{ $document->reference }}" class="mt-1 block w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block font-medium text-sm text-gray-700">Date</label>
                        <input type="date" name="date" id="date" value="{{ $document->date }}" class="mt-1 block w-full" required>
                    </div>
<div class="form-group">
    <label for="main_oeuvre">Main d'œuvre (FCFA)</label>
    <input type="number" step="0.01" name="main_oeuvre" class="form-control" value="{{ old('main_oeuvre', $document->main_oeuvre ?? 0) }}">
</div>

                    <div class="mb-4">
                        <label for="statut" class="block font-medium text-sm text-gray-700">Statut</label>
                        <select name="statut" id="statut" class="mt-1 block w-full">
                            <option value="en attente" {{ $document->statut === 'en attente' ? 'selected' : '' }}>En attente</option>
                            <option value="payé" {{ $document->statut === 'payé' ? 'selected' : '' }}>Payé</option>
                            <option value="annulé" {{ $document->statut === 'annulé' ? 'selected' : '' }}>Annulé</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('documents.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Annuler</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
